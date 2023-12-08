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
            $table->foreignUuid('client_uuid')
                ->constrained('clients', 'uuid', 'order_client');
            $table->foreignUuid('address_uuid')
                ->nullable()
                ->constrained('addresses', 'uuid', 'order_address');
            $table->string('status')->default(\App\Store\Order\Domain\Model\Enums\Status::CREATED);
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
