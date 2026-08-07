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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Payment info
            $table->string('transaction_id')->unique();
            $table->enum('payment_method', ['credit_card', 'bank_transfer', 'ewallet', 'cod'])->default('cod');
            $table->enum('payment_status', ['pending', 'success', 'failed'])->default('pending');
            
            // Amount
            $table->decimal('subtotal', 10, 2);
            $table->decimal('shipping', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('total_amount', 10, 2);
            
            // Customer info
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            
            // Shipping address
            $table->text('shipping_address');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code');
            
            // Payment timestamps
            $table->timestamp('paid_at')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('order_id');
            $table->index('user_id');
            $table->index('transaction_id');
            $table->index('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
