<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('procesos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_proceso_id');
            $table->foreign('tipo_proceso_id')->references('id')->on('process_types');
            $table->date('fecha_emision');
            $table->date('fecha_vencimiento');
            $table->integer('mes');
            $table->integer('ano');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procesos');
    }
};
