<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSortTable extends Migration
{
    public function up()
    {
		Schema::create('sort', function (Blueprint $table) {
			$table->id();
			$table->string('nom', 100);
			$table->integer('degat')->nullable();
			$table->string('element', 100)->nullable();
			$table->tinyInteger('isLumiere')->nullable();
			$table->tinyInteger('isStasis')->nullable();
			$table->tinyInteger('isCrit')->nullable();
			$table->tinyInteger('isParade')->nullable();
			$table->string('effet', 200)->nullable();
			$table->tinyInteger('isSoinArmure')->nullable();
			$table->timestamps();
		});
    }

    public function down()
    {
        Schema::dropIfExists('sort');
    }
}