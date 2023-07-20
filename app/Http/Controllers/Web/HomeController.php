<?php

namespace App\Http\Controllers\Web;

use App\Repositories\EloquentProductRepository;
use Illuminate\Support\Facades\Auth;

class HomeController
{
    public function __invoke()
    {
        if (Auth::guest()) {
            return redirect()->to('/login');
        }

        $productRepository = new EloquentProductRepository();
        $products = $productRepository->getAll(['id', 'name', 'price', 'image']);

        return view('home', [
            'products' => $products,
        ]);
    }
}
