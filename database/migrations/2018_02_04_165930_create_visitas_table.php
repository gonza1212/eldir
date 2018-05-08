<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('persona_id')->unsigned();
            $table->timestamp('fecha');
            $table->enum('tipo', ['Inicial', 'Revisita', 'Estudio'])->default('Inicial');
            $table->string('tema')->nullable();
            $table->string('textos')->nullable();
            $table->string('publicacion')->nullable();
            $table->string('pendiente')->nullable();
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
        Schema::dropIfExists('visitas');
    }
}
