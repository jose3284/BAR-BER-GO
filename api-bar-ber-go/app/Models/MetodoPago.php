<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MetodoPago extends Model
{
    use HasFactory;

    protected $table = 'metodo_pago';
    protected $primaryKey = 'idMetodo_pago';
    public $timestamps = false;

    protected $fillable = [
        'Metodo_pago'
    ];

    // Relación con recibos
    public function recibos()
    {
        return $this->hasMany(Recibo::class, 'Metodo_pago_idMetodo_pago', 'idMetodo_pago');
    }
}
