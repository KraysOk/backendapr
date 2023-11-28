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
        Schema::table('socios', function (Blueprint $table) {
            $table->string('rut')->nullable(); // Agrega el campo 'rut' a la tabla 'socios'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('socios', function (Blueprint $table) {
            $table->dropColumn('rut'); // Si deseas revertir la migración, elimina el campo 'rut'
        });
    }
};
