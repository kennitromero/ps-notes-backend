<?php

namespace App\Repositories;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Collection;

class EloquentCartRepository 
{
    public const QUATITY_INIT = 1;

    public function getUserCart(int $userId): Collection
    {
        return Cart::where('user_id', '=', $userId)->get();
    }

    public function getUserCartByProduct(int $userId, int $productId): ?Cart
    {
        return Cart::where('product_id', '=', $productId)
            ->where('user_id', '=', $userId)
            ->first();
    }

    public function createInitUserCartProduct(int $userId, int $productId): Cart
    {
        return Cart::create([
            'product_id' => $productId,
            'user_id' => $userId,
            'quantity' => self::QUATITY_INIT
        ]);
    }

    public function addAnUnitQuantity(Cart $cart): void
    {
        $cart->quantity++;
        $cart->save();
    }

    public function removeAndUnitQuantity(Cart $cart): void
    {
        $cart->quantity--;
        $cart->save();
    }

    public function deleteCart(int $cartId): void
    {
        Cart::destroy($cartId);
    }
}