<?php

namespace App\Http\Controllers\Web;

use App\Models\Cart;
use App\Repositories\EloquentCartRepository;
use App\Repositories\EloquentProductRepository;
use Illuminate\Support\Facades\Auth;

class HomeController
{
    public function __invoke()
    {
        if (Auth::guest()) {
            return redirect()->to('/login');
        }

        $userId = Auth::id();

        $productRepository = new EloquentProductRepository();
        $cartRepository = new EloquentCartRepository();

        $products = $productRepository->getAll(['id', 'name', 'price', 'image']);

        $carts = $cartRepository->getUserCart($userId);
        $quantityTotal = 0;
        foreach ($carts as $cart) {
            $quantityTotal += $cart->quantity;
        }

        return view('home', [
            'products' => $products,
            'quantityTotal' => $quantityTotal
        ]);
    }
}
