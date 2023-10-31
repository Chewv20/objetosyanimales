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
        Schema::create('objetos', function (Blueprint $table) {
            $table->id();
            $table->string('linea');
            $table->date('fecha');
            $table->string('estacion');
            $table->integer('retardo');
            $table->string('corte_corriente');
            $table->text('tipo_objeto');
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
        Schema::dropIfExists('objeto');
    }
};
