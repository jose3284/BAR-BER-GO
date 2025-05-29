<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->id('idProducto'); // clave primaria personalizada

            $table->string('Nombre', 100);
            $table->integer('Cantidad');
            $table->decimal('Precio', 10, 2); // precio con decimales
            $table->string('imagen')->nullable(); // imagen opcional

            // Foreign key hacia la tabla categoria
            $table->unsignedBigInteger('id_categoria');
            $table->foreign('id_categoria')->references('id_categoria')->on('categoria')->onDelete('cascade');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
