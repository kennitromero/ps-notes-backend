<?php

namespace App\Http\Controllers\API;

use App\UseCases\CalculateTotalAmountUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CalculateTotalAmountController
{
    public function __construct(
        private CalculateTotalAmountUseCase $calculateTotalAmountUseCase
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $products = $request->get('products');

        $totalAmount = $this->calculateTotalAmountUseCase->execute($products);

        return response()->json([
            'totalAmount' => $totalAmount
        ]);
    }
}
