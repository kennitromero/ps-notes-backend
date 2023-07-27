<?php

namespace App\Http\Controllers\Web\Cart;

use App\Repositories\EloquentCartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddProductController
{
    public function __invoke(Request $request)
    {
        $userId = Auth::id();
        $productId = (int) $request->get('product_id');
        $cartRepository = new EloquentCartRepository();

        $cartOrNull = $cartRepository->getUserCartByProduct($userId, $productId);

        if (is_null($cartOrNull)) {
            $cartRepository->createInitUserCartProduct($userId, $productId);

            return redirect()->back();
        }

        $cartRepository->addAnUnitQuantity($cartOrNull);

        return redirect()->back();
    }
}
