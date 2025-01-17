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
        Schema::create('breweries', function (Blueprint $table) {
            $table->id();
            $table->string('corporate_name');
            $table->string('trade_name');
            $table->string('cnpj', 14)->unique();
            $table->string('street');
            $table->string('neighborhood'); // Adicionando o campo neighborhood (bairro)
            $table->string('number');
            $table->string('zip_code', 8);
            $table->string('city');
            $table->string('state', 2);
            $table->timestamps(); // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breweries');
    }
};
