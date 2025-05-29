<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'cita';

    protected $fillable = [
        'nombre',
        'celular',
        'correo',
        'fecha',
        'hora',
    ];
}
