<?php

namespace App\Http\Controllers\Web\Cart;

use App\Repositories\EloquentCartRepository;
use Illuminate\Support\Facades\Auth;

class CartSummaryController
{
    public function __invoke()
    {
        $userId = Auth::id();
        $cartRepository = new EloquentCartRepository();

        $carts = $cartRepository->getUserCart($userId);
        $quantityTotal = 0;
        $amountTotal = 0;

        foreach ($carts as $cart) {
            $quantityTotal += $cart->quantity;
            $amountTotal += $cart->quantity * $cart->product->price;
        }

        return view('cart-summary', [
            'carts' => $carts,
            'quantityTotal' => $quantityTotal,
            'amountTotal' => $amountTotal
        ]);
    }
}
