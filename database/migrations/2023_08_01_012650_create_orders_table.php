<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->float('sub_total', 9, 2);
            $table->float('delivery_amount', 9, 2);
            $table->float('iva', 9, 2);
            $table->float('total', 9, 2);
            $table->enum('status', ['pending', 'complete', 'cancel'])->default('pending');
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
