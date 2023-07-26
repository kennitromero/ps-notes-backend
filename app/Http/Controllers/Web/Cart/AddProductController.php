<?php

namespace App\Http\Controllers\Web\Cart;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddProductController
{
    private const QUATITY_INIT = 1;

    public function __invoke(Request $request)
    {
        $userId = Auth::id();
        $productId = $request->get('product_id');

        $cartOrNull = Cart::where('product_id', '=', $productId)->where('user_id', '=', $userId)->first();

        if (is_null($cartOrNull)) {
            Cart::create([
                'product_id' => $productId,
                'user_id' => $userId,
                'quantity' => self::QUATITY_INIT
            ]);

            return redirect()->back();
        }

        $cartOrNull->quantity++;
        $cartOrNull->save();

        return redirect()->back();
    }
}
