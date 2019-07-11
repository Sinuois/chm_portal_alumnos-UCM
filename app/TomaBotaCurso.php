<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TomaBotaCurso extends Model
{
	protected $table = 'tomabotacursos';

	protected $fillable = [
		'id',
    	'user_id',
    	'curso_id',
		'estado',
		
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
