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
        Schema::create('anexoii', function (Blueprint $table) {
            $table->string('id');
            $table->date('fecha');
            $table->string('linea');
            $table->string('hora');
            $table->string('larin');
            $table->text('descripcion');
            $table->string('usuario');
            $table->string('hora_mov');
            $table->string('fecha_mov');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anexoii');
    }
};
