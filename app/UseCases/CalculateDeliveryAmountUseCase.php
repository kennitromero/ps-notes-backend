<?php

namespace App\UseCases;

class CalculateDeliveryAmountUseCase
{
    public function execute(int $subTotal): int
    {
        $deliveryAmount = 0;

        if ($subTotal < 312000) {
            $deliveryAmount = 45000;
        }

        if ($subTotal >= 312000 && $subTotal < 1412000) {
            $deliveryAmount = 30000;
        }

        if ($subTotal >= 1412000) {
            $deliveryAmount = 20000;
        }

        return $deliveryAmount;
    }
}