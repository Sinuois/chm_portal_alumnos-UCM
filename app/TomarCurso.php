<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TomarCurso extends Model
{
    protected $table = 'tomacursos';

    protected $fillable =[
    	'id',
    	'user_id',
    	'curso_id',
        'estado',
        'motivo',
    ];

    public function user()
    {
        return $this->BelongsTo('App\User','user_id');
    }

    public function curso()
    {
    	return $this->BelongsTo('App\Curso','curso_id');
    }
}
