<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscripcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripcions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('cohorte_id');
            $table->foreign('cohorte_id')->references('id')->on('cohortes');

            $table->unsignedBigInteger('registro_id');
            $table->foreign('registro_id')->references('id')->on('registros');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->unsignedBigInteger('informacionLaborals_id');
            $table->foreign('informacionLaborals_id')->references('id')->on('informacion_laborals');

            $table->unsignedBigInteger('informacionAcademicas_id');
            $table->foreign('informacionAcademicas_id')->references('id')->on('informacion_academicas');
            
            $table->string('descripcion')->nullable();
          
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
        Schema::dropIfExists('inscripcions');
    }
}
