<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformacionAcademicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informacion_academicas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('institucion');
            $table->enum('nivel',['TÉCNOLOGICO SUPERIOR','LICENCIATURA','TERCER NIVEL','CUARTO NIVEL','DOCTORADO'])->default('TERCER NIVEL');
            $table->enum('tipo_institucion',['PÚBLICA','PRIVADA','MIXTA'])->default('PÚBLICA');
            $table->string('titulo');
            $table->string('especialidad')->nullable();
            $table->integer('duracion')->nullable();
            $table->date('fecha_graduacion')->nullable();
            $table->decimal('calificacion_grado',8,2)->nullable();
            $table->string('pais')->nullable();
            $table->string('provincia')->nullable();
            $table->string('canton')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informacion_academicas');
    }
}
