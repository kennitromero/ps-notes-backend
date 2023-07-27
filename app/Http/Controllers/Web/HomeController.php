<?php

namespace App\Http\Controllers\Web;

use App\Models\Cart;
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
        $products = $productRepository->getAll(['id', 'name', 'price', 'image']);

        $carts = Cart::where('user_id', '=', $userId)->get();
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
