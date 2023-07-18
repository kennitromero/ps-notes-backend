<?php

namespace App\Repositories;

use App\Models\Product;

class EloquentProductRepository {

    public function store(string $name, string $image, float $price): void
    {
        Product::create([
            'name' => $name,
            'image' => $image,
            'price' => $price
        ]);
    }
}