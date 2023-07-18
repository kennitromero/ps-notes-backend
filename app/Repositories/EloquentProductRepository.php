<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class EloquentProductRepository {

    public function store(string $name, string $image, float $price): void
    {
        Product::create([
            'name' => $name,
            'image' => $image,
            'price' => $price
        ]);
    }

    public function getAll(): Collection
    {
        return Product::all(['id', 'name', 'price']);
    }
}