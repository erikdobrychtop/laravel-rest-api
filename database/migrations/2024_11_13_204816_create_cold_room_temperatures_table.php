<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColdRoomTemperaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cold_room_temperatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cold_room_id')->constrained('cold_rooms')->onDelete('cascade'); // Relacionamento com cold_rooms
            $table->dateTime('recorded_at'); // Data e horário da medição
            $table->decimal('temperature', 5, 2); // Temperatura mínima registrada
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
        Schema::dropIfExists('cold_room_temperatures');
    }
}
