<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDireccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('persona_id')->unsigned();
            $table->string('localidad', 50)->default('Puerto Madryn');
            $table->string('calle_1', 50)->nullable();
            $table->string('calle_2', 50)->nullable();
            $table->string('entre', 100)->nullable();
            $table->smallInteger('numero')->nullable();
            $table->smallInteger('depto')->nullable();
            $table->string('barrio', 50)->nullable();
            $table->string('territorio', 20)->nullable();
            $table->text('observaciones')->nullable();
            $table->foreign('persona_id')->references('id')->on('personas')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('direcciones');
    }
}
