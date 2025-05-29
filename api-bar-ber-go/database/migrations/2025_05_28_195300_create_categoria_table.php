<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriaTable extends Migration
{
    public function up()
    {
        Schema::create('categoria', function (Blueprint $table) {
            $table->id('id_categoria');
            $table->string('categoria');
            $table->timestamps(); // ✅ Aquí se agregan los timestamps correctamente
        });
    }

    public function down()
    {
        Schema::dropIfExists('categoria');
    }
}
