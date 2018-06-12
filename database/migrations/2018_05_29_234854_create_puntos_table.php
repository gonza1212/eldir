<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('fecha');
            $table->integer('territorio_id')->unsigned();
            $table->string('tipo', 30)->default('Casa');
            $table->string('direccion');
            $table->string('simbolo', 3)->default('NC');
            $table->string('observaciones')->nullable();
            $table->foreign('territorio_id')->references('id')->on('territorios')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puntos');
    }
}
