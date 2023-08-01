<?php

namespace App\Http\Controllers\Web\Checkout;

use App\Repositories\EloquentCartRepository;
use Illuminate\Support\Facades\Auth;

class CheckoutController 
{
    private const IVA_PERCENTAGE = 0.19;

    public function __invoke()
    {
        $userId = Auth::id();
        $cartRepository = new EloquentCartRepository();
        $carts = $cartRepository->getUserCart($userId);

        $subTotal = 0;
        $deliveryAmount = 0;
        foreach ($carts as $cart) {
            $subTotal += $cart->quantity * $cart->product->price;
        }

        if ($subTotal < 312000) {
            $deliveryAmount = 45000;
        }

        if ($subTotal >= 312000 && $subTotal < 1412000) {
            $deliveryAmount = 30000;
        }

        if ($subTotal >= 1412000) {
            $deliveryAmount = 20000;
        }

        $iva = ($subTotal + $deliveryAmount) * self::IVA_PERCENTAGE;

        $total = $subTotal + $deliveryAmount + $iva;

        return view('checkout', [
            'subTotal' => $subTotal,
            'deliveryAmount' => $deliveryAmount,
            'iva' => $iva,
            'total' => $total,
        ]);
    }
}