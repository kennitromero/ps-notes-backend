<?php

namespace App\Repositories;

use App\Models\OrderPayment;
use Illuminate\Database\Eloquent\Collection;

class EloquentOrderPaymentRepository
{
    public function create(array $attributes): OrderPayment
    {
        return OrderPayment::create($attributes);
    }

    public function getOrderPaymentsByOrderId(int $orderId): Collection
    {
        return OrderPayment::where('order_id', '=', $orderId)->get();
    }

    public function getOrderPaymentByReferenceCode(string $referenceCode): OrderPayment
    {
        return OrderPayment::where('reference_code', '=', $referenceCode)->first();
    }
}