<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            
            $table->string('primer_nombre')->nullable();
            $table->string('segundo_nombre')->nullable();
            $table->string('primer_apellido')->nullable();
            $table->string('segundo_apellido')->nullable();
            $table->enum('tipo_identificacion',['Cédula','Ruc persona Natural','Ruc Sociedad Pública','Ruc Sociedad Privada','Pasaporte','Otros'])->default('Cédula');
            $table->string('identificacion')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->enum('estado_civil',['Soltero/a','Casado/a','Divorciado/a','Vuido/a'])->default('Soltero/a');
            $table->enum('sexo',['Masculino','Femenino'])->default('Masculino');
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('etnia',['Mestizos','Blancos','Afroecuatorianos','Indígenas','Montubios','otros'])->default('Mestizos');
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('direccion')->nullable();
            
            $table->string('foto')->nullable();
            // discapacidad
            $table->enum('tiene_discapacidad',['SI','NO'])->default('NO');
            $table->decimal('porcentaje_discapacidad',8,2)->default(0);
            $table->enum('tiene_carnet_conadis',['SI','NO'])->default('NO');
            $table->decimal('porcentaje_carnet_conadis',8,2)->default(0);

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
        Schema::dropIfExists('users');
    }
}
