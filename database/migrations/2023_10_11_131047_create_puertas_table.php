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
        Schema::create('puertas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('hora');
            $table->string('linea');
            $table->string('estacion');
            $table->text('descripcion');
            $table->string('puerta_opuesta');
            $table->string('desalojo');
            $table->string('asistencia_policia');
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
        Schema::dropIfExists('puertas');
    }
};
