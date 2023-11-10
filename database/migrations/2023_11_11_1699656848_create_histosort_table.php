<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistosortTable extends Migration
{
    public function up()
    {
        Schema::create('histosort', function (Blueprint $table) {
            $table->integer('idSort');
            $table->integer('idPlayer');
            $table->primary(['idSort', 'idPlayer']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('histosort');
    }
}