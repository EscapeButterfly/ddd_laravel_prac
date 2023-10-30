<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('client_uuid')->constrained('clients', 'uuid', 'order_client');
            $table->string('status');
            $table->string('payment_type');
            $table->string('delivery');
            $table->string('delivery_address')->nullable();
            $table->string('delivery_contact')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
