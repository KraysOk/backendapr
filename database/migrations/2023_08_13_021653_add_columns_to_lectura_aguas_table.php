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
        Schema::table('lectura_aguas', function (Blueprint $table) {
            $table->unsignedBigInteger('proceso_id')->nullable();
            $table->unsignedBigInteger('socio_id')->nullable();
            $table->decimal('consumption_value', 8, 2)->nullable();
            
            $table->foreign('proceso_id')->references('id')->on('procesos')->onDelete('cascade');
            $table->foreign('socio_id')->references('id')->on('socios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lectura_aguas', function (Blueprint $table) {
            $table->dropForeign(['proceso_id']);
            $table->dropForeign(['socio_id']);
            
            $table->dropColumn('proceso_id');
            $table->dropColumn('socio_id');
            $table->dropColumn('consumption_value');
        });
    }
};
