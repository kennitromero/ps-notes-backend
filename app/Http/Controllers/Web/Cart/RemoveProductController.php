<?php

namespace App\Http\Controllers\Web\Cart;

use App\Models\Cart;
use App\Repositories\EloquentCartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RemoveProductController
{
    public function __invoke(Request $request)
    {
        $userId = Auth::id();
        $productId = (int) $request->get('product_id');

        $cartRepository = new EloquentCartRepository();

        $cartOrNull = $cartRepository->getUserCartByProduct($userId, $productId);

        if (is_null($cartOrNull)) {
            return redirect()->back();
        }

        if ($cartOrNull->quantity === $cartRepository::QUATITY_INIT) {
            $cartRepository->deleteCart($cartOrNull->id);
            return redirect()->back();
        }

        $cartRepository->removeAndUnitQuantity($cartOrNull);        

        return redirect()->back();
    }
}
