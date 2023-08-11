<?php

namespace App\Http\Controllers\Web\Checkout;

use App\Repositories\EloquentOrderPaymentRepository;
use App\Repositories\EloquentUserRepository;
use App\Services\PaymentService;
use App\UseCases\CreateOrderByUserCartUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class CreateOrderController
{
    public function __invoke(Request $request)
    {
        $userId = Auth::id();

        $contactPhone = $request->get('contact_phone');
        $dniNumber = $request->get('dni_number');
        $street = $request->get('address');
        $city = $request->get('city');
        $state = $request->get('state');
        $financialInstitutionCode = $request->get('financial_institution_code'); // ToDo

        try {
            $userRepository = new EloquentUserRepository();
            $user = $userRepository->findById($userId);

            $createOrderByUserCartUseCase = new CreateOrderByUserCartUseCase();
            $order = $createOrderByUserCartUseCase->execute($userId);


            $paymentService = new PaymentService();
            $paymentService->setContextPublic($request->userAgent(), $request->cookie('laravel_session'));

            $response = $paymentService->createTransaction(
                $order,
                $user,
                [
                    'contactPhone' => $contactPhone,
                    'dniNumber' => $dniNumber,
                    'street' => $street,
                    'city' => $city,
                    'state' => $state,
                    'financialInstitutionCode' => $financialInstitutionCode
                ]
            );

            $orderPaymentRepository = new EloquentOrderPaymentRepository();
            $orderPaymentRepository->create([
                'order_id' => $order->id,
                'transaction_order_id' => $response['jsonResponse']['transactionResponse']['orderId'],
                'transaction_id' => $response['jsonResponse']['transactionResponse']['transactionId'],
                'state'  => $response['jsonResponse']['transactionResponse']['state'],

                'pending_reason' => $response['jsonResponse']['transactionResponse']['pendingReason'],
                'response_code' => $response['jsonResponse']['transactionResponse']['responseCode'],

                'reference_code' => $response['transactionAttributes']['referenceCode'],
                'payment_method' => $response['transactionAttributes']['paymentMethod'],
                'financial_institution_code' => $financialInstitutionCode,
                'signature' => $response['transactionAttributes']['signature'],
                'payer_full_name' => $user->name,
                'payer_email_address' => $user->email,
                'payer_contact_phone' => $contactPhone,
                'payer_dni_number' => $dniNumber,
                'payer_address' => $street,
                'payer_city' => $city,
                'payer_state' => $state,
            ]);

            return redirect()->to($response['jsonResponse']['transactionResponse']['extraParameters']['BANK_URL']);
        } catch (Throwable $th) {
            return redirect()->back()->with('message', $th->getMessage());
        }
    }
}
