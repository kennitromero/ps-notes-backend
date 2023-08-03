<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class EloquentOrderRepository 
{
    public function getByUserId(int $userId): Collection
    {
        return Order::where('user_id', '=', $userId)
            ->withCount('orderProducts')
            ->get();
    }
}
