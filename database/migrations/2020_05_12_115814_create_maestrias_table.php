<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaestriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maestrias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre');
            $table->string('tipo_programa')->nullable();
            $table->string('campo_amplio')->nullable();
            $table->string('campo_especifico')->nullable();
            $table->string('campo_detallado')->nullable();           
            $table->string('programa')->nullable();
            $table->string('titulo')->nullable();
            $table->string('codificacion_programa')->nullable();
            $table->string('lugar_ejecucion')->nullable();
            $table->string('duracion')->nullable();
            $table->string('tipo_periodo')->nullable();
            $table->decimal('numero_horas')->nullable();
            $table->string('resolucion')->nullable();
            $table->date('fecha_resolucion')->nullable();
            $table->string('modalidad')->nullable();
            $table->string('vigencia')->nullable();
            $table->integer('paralelos')->nullable();
            $table->date('fecha_aprobacion')->nullable();
            $table->integer('capacidad_x_paralelo')->nullable();
            $table->string('foto')->nullable();
            
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
        Schema::dropIfExists('maestrias');
    }
}
