<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'cursos';

    protected $fillable =[
    	'codigo',
    	'nombre',
    	'creditos',
    	'semestre',
        'seccion',
        'motivo',
    ];


    public function tomarcursos()
    {
        return $this->hasMany('App\TomarCurso', 'curso_id');
    }

    public function tomabotacursos()
    {
        return $this->hasMany('App\TomaBotaCurso', 'curso_id');
    }
}
