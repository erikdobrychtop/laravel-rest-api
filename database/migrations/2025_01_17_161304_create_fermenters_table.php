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
        Schema::create('fermenters', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the fermenter
            $table->foreignId('brewery_id')->constrained('breweries')->onDelete('cascade'); // Relationship with breweries
            $table->timestamps(); // Includes created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fermenters');
    }
};
