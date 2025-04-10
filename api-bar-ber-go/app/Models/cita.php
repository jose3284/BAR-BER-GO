<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cita extends Model
{

    protected $table = 'cita'; // tabla utilizada en la api

    protected $fillable = [ // campos a editar en la api 
        'nombre',
        'celular',
        'correo',
        'fecha',
        'hora',
    ];
}
