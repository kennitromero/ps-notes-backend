<?php

namespace App\Console\Commands;

use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class ExampleConsumeAPICommand extends Command
{
    protected $signature = 'app:example-consume-api-command';
    protected $description = 'Comando para consumir una API de ejemplo';

    public function handle(): void
    {

        
        $payUApiKey = env('PAYU_API_KEY');
        $payUMerchantId = env('PAYU_MERCHANT_ID');
        $referenceCode = 'referenceCode';
        $txValue = 5000;
        $currencyCode = 'COP';


        $payUApiKey = '4Vj8eK4rloUd272L48hsrarnUA';
        $payUMerchantId = '508029';
        $referenceCode = 'TestPayU';
        $txValue = 3;
        $currencyCode = 'USD';

        $signatureMd5 = md5("$payUApiKey~$payUMerchantId~$referenceCode~$txValue~$currencyCode");

        dd($signatureMd5, env('PAYU_TEST_ENVIRONMENT'));


        $client = new Client([
            'base_uri' => 'https://dummyjson.com',
            'timeout' => 2
        ]);

        $response = $client->request('GET', '/products/4');

        if ($response->getStatusCode() === 200) {
            $content = json_decode($response->getBody()->getContents(), true);

            Product::create([
                'name' => $content['title'],
                'image' => $content['images'][0],
                'price' => $content['price'],
            ]);
        }
    }
}