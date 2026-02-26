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
            $table->string('session_id')->unique();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('product_name');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('unit_price');    // w groszach
            $table->unsignedInteger('total_amount');  // w groszach
            $table->string('currency', 3)->default('PLN');
            $table->string('status')->default('pending'); // pending|paid|failed
            $table->string('p24_order_id')->nullable();
            $table->string('p24_token')->nullable();
            $table->timestamps();

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
