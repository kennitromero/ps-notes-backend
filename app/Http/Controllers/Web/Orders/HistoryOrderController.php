<?php

namespace App\Http\Controllers\Web\Orders;

use App\Repositories\EloquentOrderRepository;
use Illuminate\Support\Facades\Auth;

class HistoryOrderController
{
    public function __invoke()
    {
        $userId = Auth::id();
        $orderRepository = new EloquentOrderRepository();

        $orders = $orderRepository->getByUserId($userId);

        return view('orders.history', [
            'orders' => $orders,
        ]);
    }
}