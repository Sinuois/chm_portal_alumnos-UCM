<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InscripcionesTesis extends Model
{
     protected $fillable = [
        'id', 'AlumnoId', 'ProfesorId',
        'DirectorId','CodigoInscripcion', 'Estado', 'created_at', 'updated_at',
    ];
}
