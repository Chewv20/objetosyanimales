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
        Schema::create('estacionesvias', function (Blueprint $table) {
            $table->string('id_estacion');
            $table->string('linea');
            $table->string('estacion');
            $table->float('longitud')->nullable();
            $table->float('latitud')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estacionesvias');
    }
};
