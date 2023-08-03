<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $fillable =  [
        'sub_total',
        'delivery_amount',
        'iva',
        'total',
        'status',
        'user_id',
    ];
}
