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
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('driver_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('order_number')->unique();
            
            // Pickup location
            $table->text('pickup_address');
            $table->decimal('pickup_latitude', 10, 8);
            $table->decimal('pickup_longitude', 11, 8);
            
            // Destination location
            $table->text('destination_address');
            $table->decimal('destination_latitude', 10, 8);
            $table->decimal('destination_longitude', 11, 8);
            
            // Order details
            $table->decimal('distance', 8, 2); // KM
            $table->integer('estimated_time')->nullable(); // minutes
            $table->decimal('price', 10, 2);
            
            // Status
            $table->enum('status', [
                'pending', 
                'accepted', 
                'picked_up', 
                'in_progress', 
                'completed', 
                'cancelled'
            ])->default('pending');
            
            // Payment
            $table->enum('payment_method', ['cash', 'ewallet'])->default('cash');
            $table->enum('payment_status', ['pending', 'paid'])->default('pending');
            
            // Notes
            $table->text('driver_notes')->nullable();
            $table->text('customer_notes')->nullable();
            
            // Cancellation
            $table->enum('cancelled_by', ['user', 'driver'])->nullable();
            $table->text('cancellation_reason')->nullable();
            
            // Timestamps
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index('status');
            $table->index('order_number');
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
