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
        Schema::create('zapatas', function (Blueprint $table) {
            $table->id();
            $table->string('linea');
            $table->date('fecha');
            $table->string('hora');
            $table->text('descripcion');
            $table->string('humo');
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
        Schema::dropIfExists('zapatas');
    }
};
