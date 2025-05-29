<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('idUsuario'); // Clave primaria
            $table->string('Nombre', 100);
            $table->string('P_apellido', 100);
            $table->string('S_apellido', 100)->nullable();
            $table->string('Pass');
            $table->string('Correo')->unique();
            $table->foreignId('id_roles')->constrained('roles', 'id_roles')->onDelete('cascade');
            $table->boolean('userState')->default(true);
            $table->string('reset_token')->nullable();
            $table->dateTime('reset_expiration')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
