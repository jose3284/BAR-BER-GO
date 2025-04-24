<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'idUsuario';
    public $timestamps = false;

    protected $fillable = [
        'Nombre',
        'P_apellido',
        'S_apellido',
        'Pass',
        'Correo',
        'id_roles',
        'userState',
        'reset_token',
        'reset_expiration'
    ];

    protected $hidden = [
        'Pass'
    ];

    public function getAuthPassword()
    {
        return $this->Pass;
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_roles', 'id_roles');
    }
}
