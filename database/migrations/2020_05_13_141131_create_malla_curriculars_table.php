<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMallaCurricularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('malla_curriculars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('nivel')->nullable();
            $table->string('categoria')->nullable();
            $table->integer('subindice')->nullable();

            $table->unsignedBigInteger('paralelo_id');
            $table->foreign('paralelo_id')->references('id')->on('paralelos');

            $table->unsignedBigInteger('materia_id');
            $table->foreign('materia_id')->references('id')->on('materias');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('creado_x')->nullable();
            $table->bigInteger('editado_x')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('malla_curriculars');
    }
}
