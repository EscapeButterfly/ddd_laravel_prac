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
        Schema::create('store_books', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUlid('store_uuid')->constrained('stores', 'uuid', 'store_books');
            $table->foreignUlid('book_uuid')->constrained('books', 'uuid', 'books_store');
            $table->integer('quantity')->nullable();
            $table->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_books');
    }
};
