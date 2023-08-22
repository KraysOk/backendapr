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
        Schema::create('tramos', function (Blueprint $table) {
            $table->id();
            $table->integer('inicio');  // inicio del tramo
            $table->integer('fin')->nullable();  // fin del tramo, null para "A" (sin límite superior)
            $table->integer('valor');  // valor asociado al tramo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tramos');
    }
};
