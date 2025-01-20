<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFermenterIdToBatchesTable extends Migration
{
    public function up()
    {
        Schema::table('batches', function (Blueprint $table) {
            $table->unsignedBigInteger('fermenter_id')->nullable()->after('id');
            
            // Caso a tabela fermenters exista, pode ser adicionada uma foreign key:
            $table->foreign('fermenter_id')->references('id')->on('fermenters')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('batches', function (Blueprint $table) {
            $table->dropForeign(['fermenter_id']);
            $table->dropColumn('fermenter_id');
        });
    }
}