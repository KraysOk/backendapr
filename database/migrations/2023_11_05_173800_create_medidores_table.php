<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedidoresTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('medidores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('socio_id');
            $table->foreign('socio_id')->references('id')->on('socios');
            $table->string('numero');
            $table->float('lectura', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('medidores');
    }
}
