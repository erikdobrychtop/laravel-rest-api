<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchesTable extends Migration
{
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('batch')->unique();
            $table->string('map_register')->nullable();
            $table->date('production_date');
            $table->decimal('abv', 5, 2)->nullable(); // Example: 5.25%
            $table->integer('ibu')->nullable(); // Bitterness Units
            $table->decimal('mash_brix', 5, 2)->nullable();
            $table->decimal('pre_boil_brix', 5, 2)->nullable();
            $table->decimal('post_boil_brix', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('batches');
    }
}
