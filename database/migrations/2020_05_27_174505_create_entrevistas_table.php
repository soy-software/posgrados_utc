<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrevistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrevistas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->decimal('nota',8,2)->nullable();
            $table->enum('opcion',['Excelente','Muy bueno','Bueno','Regular','Pobre'])->nullable();
            $table->unsignedBigInteger('admision_id');
            $table->foreign('admision_id')->references('id')->on('admisions');

            $table->unsignedBigInteger('bancoPreguntas_id');
            $table->foreign('bancoPreguntas_id')->references('id')->on('banco_preguntas');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entrevistas');
    }
}
