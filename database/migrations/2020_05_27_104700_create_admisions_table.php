<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admisions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('examen',8,2)->nullable();
            $table->decimal('entrevista',8,2)->nullable();
            $table->decimal('ensayo',8,2)->nullable();
            $table->enum('estado',['Aprobado','Reprobado'])->default('Reprobado');

            $table->unsignedBigInteger('cohorte_id');
            $table->foreign('cohorte_id')->references('id')->on('cohortes');
            
            $table->unsignedBigInteger('inscripcion_id');
            $table->foreign('inscripcion_id')->references('id')->on('inscripcions');

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
        Schema::dropIfExists('admisions');
    }
}
