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
        Schema::create('larinesii', function (Blueprint $table) {
            $table->integer('id_larin');
            $table->string('tipo_larin');
            $table->string('clave_larin');
            $table->text('descripcion_corta_larin');
            $table->text('larin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('larinesii');
    }
};
