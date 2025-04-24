<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';
    protected $primaryKey = 'idProducto';
    public $timestamps = false;

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'Nombre',
        'Cantidad',
        'Precio',
        'imagen',
        'id_categoria'
    ];

    public function categoria()
{
    return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
}

}

