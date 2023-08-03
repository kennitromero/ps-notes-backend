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
            ->withCount('orderProducts')
            ->get();
    }

    public function getByUserEmail(string $userEmail, array $attributes): Collection
    {
        return Order::select($attributes)
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->withCount('orderProducts')
            ->where('users.email', '=', $userEmail)
            ->get();
    }

    public function updateStatusByOrderId(int $orderId, string $newStatus): void
    {
        Order::where('id', '=', $orderId)
            ->update(['status' => $newStatus]);
    }
}
