<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accidentados', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('linea');
            $table->string('hora');
            $table->string('estacion');
            $table->string('tren')->nullable();
            $table->string('via');
            $table->text('descripcion');
            $table->string('genero');
            $table->integer('edad')->nullable();
            $table->integer('retardo');
            $table->string('usuario');
            $table->string('usu_correccion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accidentados');
    }
};
