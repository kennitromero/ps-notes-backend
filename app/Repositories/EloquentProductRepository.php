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

    public function getAll(array $columns): Collection
    {
        return Product::all($columns);
    }

    public function findByID(int $productID): Product
    {
        return Product::find($productID);
    }

    public function update(int $productID, string $name, string $image, float $price): void
    {
        $product = $this->findByID($productID);
        $product->name = $name;
        $product->image = $image;
        $product->price = $price;

        $product->save();
    }

    public function delete(int $productID): void
    {
        Product::destroy($productID);
    }
}