<?php

namespace App\Http\Controllers\Web\Cart;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RemoveProductController
{
    private const QUATITY_INIT = 1;

    public function __invoke(Request $request)
    {
        $userId = Auth::id();
        $productId = $request->get('product_id');

        $cartOrNull = Cart::where('product_id', '=', $productId)->where('user_id', '=', $userId)->first();

        if (is_null($cartOrNull)) {
            return redirect()->back();
        }

        if ($cartOrNull->quantity === self::QUATITY_INIT) {
            Cart::destroy($cartOrNull->id);
            return redirect()->back();
        }

        $cartOrNull->quantity--;
        $cartOrNull->save();

        return redirect()->back();
    }
}
