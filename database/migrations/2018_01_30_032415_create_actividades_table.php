<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->timestamp('fecha');
            $table->tinyInteger('horas')->default(0);
            $table->tinyInteger('minutos')->default(0);
            $table->string('acompanante', 50)->default('...');
            $table->tinyInteger('publicaciones')->unsigned()->default(0);
            $table->tinyInteger('videos')->unsigned()->default(0);
            $table->tinyInteger('revisitas')->unsigned()->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('actividades');
    }
}
