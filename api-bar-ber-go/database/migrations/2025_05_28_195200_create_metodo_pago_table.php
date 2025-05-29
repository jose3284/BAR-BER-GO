<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('metodo_pago', function (Blueprint $table) {
            $table->id('idMetodo_pago'); // clave primaria personalizada
            $table->string('Metodo_pago', 100); // campo de nombre
            // Sin timestamps porque $timestamps = false en el modelo
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metodo_pago');
    }
};
