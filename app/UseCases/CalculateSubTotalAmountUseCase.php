<?php

namespace App\UseCases;

use Illuminate\Database\Eloquent\Collection;

class CalculateSubTotalAmountUseCase
{
    public function execute(Collection $userCart): int
    {
        $subTotalAmount = 0;

        foreach ($userCart as $cart) {
            $subTotalAmount += $cart->quantity * $cart->product->price;
        }

        return $subTotalAmount;
    }
}
