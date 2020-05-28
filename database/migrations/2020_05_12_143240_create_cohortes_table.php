<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCohortesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cohortes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('numero');
            $table->string('sede');
            $table->string('modalidad');
            
            $estados = array(
                'Procedimiento de difusión', // cuand se crea
                'Postulación e inscripción', // para promocionar
                'Admisión y matricula', // para matricular
                'Desarrollo académico', // en clases
                'Finalizado', // finalizadp
            );

            $table->enum('estado',$estados)->default($estados[0]);
            $table->unsignedBigInteger('maestria_id');
            $table->foreign('maestria_id')->references('id')->on('maestrias');
            
            $table->integer('paralelo');
            $table->decimal('valor_inscripcion',19,2);
            $table->decimal('valor_matricula',19,2);
            $table->decimal('valor_colegiatura',19,2);

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
        Schema::dropIfExists('cohortes');
    }
}
