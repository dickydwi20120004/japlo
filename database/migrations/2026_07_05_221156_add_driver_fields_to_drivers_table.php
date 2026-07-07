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
        Schema::table('drivers', function (Blueprint $table) {
            // Rename vehicle_number to license_plate if not exists
            if (Schema::hasColumn('drivers', 'vehicle_number')) {
                $table->renameColumn('vehicle_number', 'license_plate');
            }
            
            // Add address field if not exists
            if (!Schema::hasColumn('drivers', 'address')) {
                $table->text('address')->nullable()->after('license_number');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            if (Schema::hasColumn('drivers', 'license_plate')) {
                $table->renameColumn('license_plate', 'vehicle_number');
            }
            if (Schema::hasColumn('drivers', 'address')) {
                $table->dropColumn('address');
            }
        });
    }
};
