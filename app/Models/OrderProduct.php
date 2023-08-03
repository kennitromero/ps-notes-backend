<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    public $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity',
        'sub_total',
    ];
}
