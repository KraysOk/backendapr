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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('socio_id');
            $table->unsignedBigInteger('proceso_id');
            $table->string('tipo_pago');
            $table->decimal('monto_total', 10, 2);
            $table->timestamps();

            // Add foreign key constraints if needed
            $table->foreign('socio_id')->references('id')->on('socios');
            $table->foreign('proceso_id')->references('id')->on('procesos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
