<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');

            // Información que proviene de la respuesta de PayU
            $table->unsignedBigInteger('transaction_order_id');
            $table->string('transaction_id');
            $table->enum('state', ['APPROVED', 'PENDING', 'DECLINED']);

            $table->string('pending_reason');
            $table->string('response_code');

            // Información que envíamos a PayU
            $table->string('reference_code');
            $table->enum('payment_method', ['PSE']);
            $table->string('financial_institution_code');

            $table->string('signature');
            $table->string('payer_full_name');
            $table->string('payer_email_address');
            $table->string('payer_contact_phone');
            $table->string('payer_dni_number');
            $table->string('payer_address');
            $table->string('payer_city');
            $table->string('payer_state');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_payments');
    }
};
