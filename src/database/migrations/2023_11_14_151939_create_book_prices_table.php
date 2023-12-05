<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_prices', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('book_uuid')->constrained('books', 'uuid', 'book_price');
            $table->decimal('price');
            $table->string('currency');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_prices');
    }
};
