<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40)->unique();
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->enum('type', ['member', 'admin'])->default('member');
            $table->string('profile')->nullable(); //url de la imagen de perfil
            $table->tinyInteger('letra_grande')->default(0);
            $table->enum('condicion', ['Publicador', 'Precursor Auxiliar', 'Precursor Regular'])->default('Publicador');
            $table->tinyInteger('meta')->unsigned()->default(0);
            $table->tinyInteger('meta_activa')->default(0); // Por defecto, la meta de horas esta desactivada
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
