<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    public $fillable = [
        'order_id',
        'transaction_order_id',
        'transaction_id',
        'state',

        'pending_reason',
        'response_code',

        'reference_code',
        'payment_method',
        'financial_institution_code',
        'signature',
        'payer_full_name',
        'payer_email_address',
        'payer_contact_phone',
        'payer_dni_number',
        'payer_address',
        'payer_city',
        'payer_state'
    ];
}
