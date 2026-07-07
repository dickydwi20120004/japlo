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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('vehicle_type')->default('motor'); // motor, mobil
            $table->string('vehicle_brand')->nullable();
            $table->string('license_plate'); // Nomor plat kendaraan
            $table->string('vehicle_color')->nullable();
            $table->string('license_number'); // Nomor SIM
            $table->string('identity_number')->nullable(); // KTP
            $table->text('address')->nullable(); // Alamat lengkap
            $table->boolean('is_available')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->decimal('current_latitude', 10, 8)->nullable();
            $table->decimal('current_longitude', 11, 8)->nullable();
            $table->decimal('rating', 3, 2)->default(5.00);
            $table->integer('total_rides')->default(0);
            $table->decimal('total_earnings', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
