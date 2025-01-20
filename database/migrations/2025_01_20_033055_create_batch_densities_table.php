<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchDensitiesTable extends Migration
{
    public function up()
    {
        Schema::create('batch_densities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batch_id')->constrained('batches')->onDelete('cascade');
            $table->decimal('density', 5, 3); // Example: 1.050
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('batch_densities');
    }
}
