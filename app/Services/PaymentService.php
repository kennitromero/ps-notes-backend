<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;

class PaymentService
{
    private string $payUHost;
    private string $payUApiLogin;
    private string $payUApiKey;
    private bool $payUTestEnvironment;
    private string $payUAccountId;
    private string $payUMerchantId;

    private string $sessionId;
    private string $ipServer;
    private string $notificationUrl;
    private string $redirectToOurMerchantUrl;

    private string $userAgent;
    private string $cookie;

    private Client $client;

    public function __construct()
    {
        $this->payUHost = env('PAYU_HOST');
        $this->payUApiLogin = env('PAYU_API_LOGIN');
        $this->payUApiKey = env('PAYU_API_KEY');
        $this->payUTestEnvironment = (bool) env('PAYU_TEST_ENVIRONMENT');
        $this->payUAccountId = env('PAYU_ACCOUNT_ID');
        $this->payUMerchantId = env('PAYU_MERCHANT_ID');

        $this->context();

        $this->client = new Client([
            'base_uri' => $this->payUHost,
            'timeout' => 30
        ]);
    }

    private function context(): void
    {
        $this->sessionId = session()->getId();
        $this->ipServer = request()->server('SERVER_NAME');
        $this->notificationUrl = url('payu-notify-url');
        $this->redirectToOurMerchantUrl = url('/checkout-summary');
    }

    public function setContextPublic(string $userAgent, string $session): void
    {
        $this->userAgent = $userAgent;
        $this->cookie = $session;
    }

    public function getBanks(): array
    {
        $response = $this->client->request('POST', '/payments-api/4.0/service.cgi', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => [
                'language' => 'es',
                'command' => 'GET_BANKS_LIST',
                'merchant' => [
                    'apiLogin' => $this->payUApiLogin,
                    'apiKey' => $this->payUApiKey
                ],
                'test' => $this->payUTestEnvironment,
                'bankListInformation' => [
                    'paymentMethod' => 'PSE',
                    'paymentCountry' => 'CO'
                ]
            ]
        ]);

        if (!$response->getStatusCode() === 200) {
            throw new Exception('No pudimos cargar los bancos, inténtelo nuevamente.');
        }

        $body = $response->getBody()->getContents();
        $content = json_decode($body, true);

        return $content['banks'];
    }

    public function createTransaction(Order $order, User $user, array $payerAttributes): array
    {
        $referenceCode = "ORDER_JAMER_$order->id";
        $txValue = $order->total;
        $currencyCode = 'COP';
        $paymentMethod = 'PSE';

        $signature = md5("$this->payUApiKey~$this->payUMerchantId~$referenceCode~$txValue~$currencyCode");


        $payload = [
            'language' => 'es',
            'command' => 'SUBMIT_TRANSACTION',
            'merchant' => [
                'apiLogin' => $this->payUApiLogin,
                'apiKey' => $this->payUApiKey
            ],
            'test' => $this->payUTestEnvironment,
            'transaction' => [
                'type' => 'AUTHORIZATION_AND_CAPTURE',
                'paymentMethod' => $paymentMethod,
                'paymentCountry' => 'CO',
                'deviceSessionId' => $this->sessionId,
                'ipAddress' => $this->ipServer,
                'cookie' => $this->cookie,
                'userAgent' => $this->userAgent,
                'order' => [
                    'accountId' => $this->payUAccountId,
                    'referenceCode' => $referenceCode,
                    'description' => 'Compra en la famosa tienda Jamer/Sincelejo',
                    'language' => 'es',
                    'signature' => $signature,
                    'notifyUrl' => $this->notificationUrl,
                    'additionalValues' => [
                        'TX_VALUE' => [
                            'value' => $txValue,
                            'currency' => $currencyCode
                        ],
                        'TX_TAX' => [
                            'value' => $order->iva,
                            'currency' => $currencyCode
                        ],
                        'TX_TAX_RETURN_BASE' => [
                            'value' => $order->total - $order->iva,
                            'currency' => $currencyCode
                        ]
                    ],
                    'buyer' => [
                        'merchantBuyerId' => $user->id,
                        'fullName' => $user->name,
                        'emailAddress' => $user->email,
                        'contactPhone' => $payerAttributes['contactPhone'],
                        'dniNumber' => $payerAttributes['dniNumber'],
                        'shippingAddress' => [
                            'street1' => $payerAttributes['street'],
                            'street2' => $payerAttributes['street'],
                            'city' => $payerAttributes['city'],
                            'state' => $payerAttributes['state']
                        ]
                    ],
                    'shippingAddress' => [
                        'street1' => $payerAttributes['street'],
                        'street2' => $payerAttributes['street'],
                        'city' => $payerAttributes['city'],
                        'state' => $payerAttributes['state'],
                        'country' => 'CO',
                        'postalCode' => '700001',
                        'phone' => $payerAttributes['contactPhone']
                    ]
                ],
                'payer' => [
                    'merchantPayerId' => $user->id,
                    'fullName' => $user->name,
                    'emailAddress' => $user->email,
                    'contactPhone' => $payerAttributes['contactPhone'],
                    'dniNumber' => $payerAttributes['dniNumber'],
                    'billingAddress' => [
                        'street1' => $payerAttributes['street'],
                        'street2' => $payerAttributes['street'],
                        'city' => $payerAttributes['city'],
                        'state' => $payerAttributes['state'],
                        'country' => 'CO',
                        'postalCode' => '700001',
                        'phone' => $payerAttributes['contactPhone']
                    ]
                ],
                'extraParameters' => [
                    'RESPONSE_URL' => $this->redirectToOurMerchantUrl,
                    'PSE_REFERENCE1' => $this->ipServer,
                    'FINANCIAL_INSTITUTION_CODE' => $payerAttributes['financialInstitutionCode'],
                    'USER_TYPE' => 'N',
                    'PSE_REFERENCE2' => 'CC',
                    'PSE_REFERENCE3' => $payerAttributes['dniNumber']
                ]
            ]
        ];

        $response = $this->client->request('POST', '/payments-api/4.0/service.cgi', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => $payload
        ]);

        if (!$response->getStatusCode() === 200) {
            throw new Exception('No pudimos procesar el pago, intente nuevamente.');
        }

        $jsonResponse = json_decode($response->getBody()->getContents(), true);

        if (!$jsonResponse['code'] === 'SUCCESS') {
            throw new Exception('Pago no procesado correctamente, inténtelo nuevamente.');
        }

        return [
            'jsonResponse' => $jsonResponse,
            'transactionAttributes' => [
                'referenceCode' => $referenceCode,
                'paymentMethod' => $paymentMethod,
                'signature' => $signature,
            ]
        ];
    }
}
