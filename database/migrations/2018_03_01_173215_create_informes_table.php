<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('informado')->default(0);
            $table->tinyInteger('horas_informadas')->default(0);
            $table->string('informe_redactado')->nullable();
            $table->tinyInteger('mes_informado')->nullable();
            $table->smallInteger('year_informado')->nullable();
            $table->tinyInteger('mes_receptor')->nullable();
            $table->smallInteger('year_receptor')->nullable();
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
        Schema::dropIfExists('informes');
    }
}
