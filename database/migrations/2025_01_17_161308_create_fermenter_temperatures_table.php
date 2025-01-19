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
        Schema::create('fermenter_temperatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fermenter_id')->constrained('fermenters')->onDelete('cascade'); // Relationship with fermenters
            $table->dateTime('recorded_at'); // Date and time of the measurement
            $table->decimal('temperature', 5, 2); // Minimum recorded temperature
            $table->timestamps(); // Includes created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fermenter_temperatures');
    }
};
