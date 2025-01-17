<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColdRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cold_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome da câmara fria
            $table->foreignId('brewery_id')->constrained('breweries')->onDelete('cascade'); // Relacionamento com brewery
            $table->timestamps(); // Inclui created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cold_rooms');
    }
}
