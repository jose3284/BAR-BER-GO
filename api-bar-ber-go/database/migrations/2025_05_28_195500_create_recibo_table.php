<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recibo', function (Blueprint $table) {
            $table->id('idRecibo'); // Clave primaria

            $table->date('Fecha');
            $table->time('Hora');
            $table->decimal('Total', 10, 2);

            // Relaciones con claves foráneas
            $table->foreignId('Producto_idProducto')
                  ->constrained('producto', 'idProducto')
                  ->onDelete('cascade');

            $table->foreignId('Metodo_pago_idMetodo_pago')
                  ->constrained('metodo_pago', 'idMetodo_pago')
                  ->onDelete('restrict');

            $table->foreignId('Usuarios_idUsuario')
                  ->constrained('usuarios', 'idUsuario')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recibo');
    }
};
