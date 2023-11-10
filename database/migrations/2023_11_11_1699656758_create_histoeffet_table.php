<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoeffetTable extends Migration
{
    public function up()
{
    Schema::create('histoeffet', function (Blueprint $table) {
        $table->id();
        $table->string('effet', 100);
        $table->integer('idPlayer');
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('histoeffet');
    }
}