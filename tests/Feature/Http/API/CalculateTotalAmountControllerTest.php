<?php

namespace Tests\Feature\Http\API;

use Tests\TestCase;

class CalculateTotalAmountControllerTest  extends TestCase
{
    public function testCalculateTotalAmountResponseSuccess(): void
    {
        // Dado
        $products = [
            10000,
            200,
            30,
            300,
            5000
        ];

        // Cuando
        $response = $this->postJson('api/1.0/products/calculate-total-amount', [
            'products' => $products
        ]);

        // Debería
        $response->assertJson([
            "totalAmount" => 17530
        ]);
    }
}
