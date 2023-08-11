<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class EloquentOrderRepository
{
    public function findById(int $orderId): ?Order
    {
        return Order::find($orderId);
    }

    public function getByUserId(int $userId): Collection
    {
        return Order::where('user_id', '=', $userId)
            ->get();
    }

    public function getByUserEmail(string $userEmail, array $attributes): Collection
    {
        return Order::select($attributes)
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->where('users.email', '=', $userEmail)
            ->get();
    }

    public function createOrder(
        int $subTotal,
        int $deliveryAmount,
        int $iva,
        int $total,
        int $quantityTotal,
        int $userId
    ): Order {
        return Order::create([
            'sub_total' => $subTotal,
            'delivery_amount' => $deliveryAmount,
            'iva' => $iva,
            'total' => $total,
            'quantity_products' => $quantityTotal,
            'status' => 'pending',
            'user_id' => $userId,
        ]);
    }

    public function updateStatusByOrderId(int $orderId, string $newStatus): void
    {
        Order::where('id', '=', $orderId)
            ->update(['status' => $newStatus]);
    }
}
