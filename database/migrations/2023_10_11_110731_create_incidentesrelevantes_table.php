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
        Schema::create('incidentesrelevantes', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('linea');
            $table->string('lugar');
            $table->string('evento');
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
        Schema::dropIfExists('incidentesrelevantes');
    }
};
