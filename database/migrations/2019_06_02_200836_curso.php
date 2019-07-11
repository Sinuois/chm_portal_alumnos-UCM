<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Curso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('codigo');
            $table->string('nombre');
            $table->integer('creditos');
            $table->enum('seccion',['seccion 1','seccion 2'])->default('seccion 1');   
            $table->integer('semestre');
            //$table->enum('motivo',['sin_prerequisito','con_prerequisito','no lo inscribi', 'aumento de creditos']);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos');
    }
}
