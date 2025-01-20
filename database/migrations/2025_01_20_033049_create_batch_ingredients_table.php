<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchIngredientsTable extends Migration
{
    public function up()
    {
        Schema::create('batch_ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batch_id')->constrained('batches')->onDelete('cascade');
            $table->string('name');
            $table->string('stage'); // Mash, Boil, Dry Hopping
            $table->decimal('quantity', 10, 2); // Example: 5.00 kg
            $table->decimal('value', 10, 2)->nullable(); // Ingredient cost
            $table->decimal('temperature', 5, 2)->nullable(); // Example: 65.5 °C
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('batch_ingredients');
    }
}
