<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('estado',['Validado','Sin validar'])->default('Sin validar');
            $table->decimal('valor',19,2);
            $table->string('factura')->nullable();
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('cohorte_id');
            $table->foreign('cohorte_id')->references('id')->on('cohortes');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('institucion');
            $table->string('titulo');
            $table->string('especialidad')->nullable();
          
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
        Schema::dropIfExists('registros');
    }
}
