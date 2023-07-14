<?php

namespace App\UseCases;

class CalculateTotalAmountUseCase
{
    private const QUANTITY_FOUR = 4;
    private const QUANTITY_SIX = 6;
    private const QUANTITY_TEN = 10;

    public function execute(array $products): int
    {
        $subTotal = $this->calculateSubTotalByPrices($products);
        $quantityProducts = sizeof($products);

        return $subTotal + $this->calculateDeliveryAmount($quantityProducts);
    }

    private function calculateSubTotalByPrices(array $products): int 
    {
        $subTotal = 0;

        foreach ($products as $product) {
            $subTotal += $product;
        }

        return $subTotal;
    }

    private function calculateDeliveryAmount(int $quantityProducts): int
    {
        $deliveryAmount = 0;

        if ($quantityProducts < self::QUANTITY_FOUR) {
            $deliveryAmount = 4000;
        }

        if ($quantityProducts >= self::QUANTITY_FOUR && $quantityProducts < self::QUANTITY_SIX) {
            $deliveryAmount = 2000;
        }

        if ($quantityProducts >= self::QUANTITY_SIX && $quantityProducts < self::QUANTITY_TEN) {
            $deliveryAmount = 1000;
        }

        return $deliveryAmount;
    }
}
