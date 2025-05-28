<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categoria', function (Blueprint $table) {
            $table->id('id_categoria'); // clave primaria personalizada
            $table->string('categoria'); // nombre de la categoría
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categoria');
    }
};
