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

            // Relaciones
            $table->unsignedBigInteger('Producto_idProducto');
            $table->foreign('Producto_idProducto')->references('idProducto')->on('producto')->onDelete('cascade');

            $table->unsignedBigInteger('Metodo_pago_idMetodo_pago');
            $table->foreign('Metodo_pago_idMetodo_pago')->references('idMetodo_pago')->on('metodo_pago')->onDelete('restrict');

            $table->unsignedBigInteger('Usuarios_idUsuario');
            $table->foreign('Usuarios_idUsuario')->references('idUsuario')->on('usuarios')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recibo');
    }
};
