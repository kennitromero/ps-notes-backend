<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('quantity');

            $table->foreign('product_id')->on('products')->references('id');
            $table->foreign('user_id')->on('users')->references('id');

            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
