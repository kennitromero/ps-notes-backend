<?php

namespace App\Repositories;

use App\Models\OrderProduct;

class EloquentOrderProductRepository 
{
    public function create(int $orderId, int $productId, int $price, $quantity): OrderProduct
    {
        return OrderProduct::create([
            'order_id' => $orderId,
            'product_id' => $productId,
            'price' => $price,
            'quantity' => $quantity,
            'sub_total' => $price * $quantity,
        ]);
    }
}