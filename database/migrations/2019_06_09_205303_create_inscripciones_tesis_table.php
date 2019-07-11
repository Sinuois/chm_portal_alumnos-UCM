<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscripcionesTesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripciones_tesis', function (Blueprint $table) {
            
            $table->increments('id');
            $table->Integer('Alumno_id')->nullable();
            $table->Integer('Profesor_id')->nullable();
            $table->Integer('Director_id')->nullable();
            $table->string('CodigoIncripcion');
            $table->string('Comision1');
            $table->string('Comision2');
            $table->string('Comision3');
            $table->string('Semestre');
            $table->String('Nombre_tesis');
            $table->longText('DescripcionTesis');
            $table->longText('ObjetivosTema');
            $table->longText('ContribucionEsperada');
            $table->date('FechaInscripcion');
            $table->date('FechaTesis');
            $table->String('Estado');
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
        Schema::dropIfExists('inscripciones_tesis');
    }
}
