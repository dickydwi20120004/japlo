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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            
            // Item details
            $table->string('item_name');
            $table->string('item_type'); // 'food', 'product', 'health', etc
            $table->integer('item_id')->nullable(); // Reference to original item
            $table->integer('quantity');
            $table->decimal('price', 10, 2); // Price per unit
            $table->decimal('subtotal', 10, 2); // quantity * price
            
            // Additional notes
            $table->text('notes')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('order_id');
            $table->index('item_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
