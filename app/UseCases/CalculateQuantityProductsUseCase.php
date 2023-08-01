<?php

namespace App\UseCases;

use Illuminate\Database\Eloquent\Collection;

class CalculateQuantityProductsUseCase
{
    public function execute(Collection $userCart): int
    {
        $quantityTotal = 0;

        foreach ($userCart as $cart) {
            $quantityTotal += $cart->quantity;
        }

        return $quantityTotal;
    }
}