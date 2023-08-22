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
        Schema::create('socio_servicio_proceso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('socio_id');
            $table->unsignedBigInteger('servicio_id');
            $table->unsignedBigInteger('proceso_id');
            $table->float('valor'); // Este es el valor asociado para el servicio, socio y proceso específicos

            $table->foreign('socio_id')->references('id')->on('socios')->onDelete('cascade');
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');
            $table->foreign('proceso_id')->references('id')->on('procesos')->onDelete('cascade');

            // Podemos agregar un índice único para asegurar que no haya entradas duplicadas
            $table->unique(['socio_id', 'servicio_id', 'proceso_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('socio_servicio_proceso');
    }
};
