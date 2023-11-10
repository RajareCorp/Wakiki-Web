<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerTable extends Migration
{
    public function up()
    {
		Schema::create('player', function (Blueprint $table) {
			$table->id();
			$table->string('nom', 100);
			$table->integer('armure')->nullable();
			$table->integer('degat')->nullable();
			$table->integer('soin')->nullable();
			$table->integer('nbCC')->nullable();
			$table->integer('nbParade')->nullable();
			$table->integer('protecteurRecule')->nullable();
			$table->integer('auContact')->nullable();
			$table->timestamps();
		});
    }

    public function down()
    {
        Schema::dropIfExists('player');
    }
}