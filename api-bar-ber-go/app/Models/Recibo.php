<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recibo extends Model
{
    use HasFactory;

    protected $table = 'recibo';
    protected $primaryKey = 'idRecibo';
    public $timestamps = false;

    protected $fillable = [
        'Fecha',
        'Hora',
        'Total',
        'Producto_idProducto',
        'Metodo_pago_idMetodo_pago',
        'Usuarios_idUsuario'
    ];

    // Relaciones

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'Producto_idProducto', 'idProducto');
    }

    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class, 'Metodo_pago_idMetodo_pago', 'idMetodo_pago');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'Usuarios_idUsuario', 'idUsuario');
    }
}
