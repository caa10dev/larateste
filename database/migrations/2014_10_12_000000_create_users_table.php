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
            $table->string('name');
            $table->integer('resident_id')->unsigned()->nullable();
            $table->foreign('resident_id')->references('id')->on('residents');
            $table->integer('tower_id')->unsigned()->nullable();
            $table->foreign('tower_id')->references('id')->on('towers');
            $table->integer('condominio_id')->unsigned()->nullable();
            $table->foreign('condominio_id')->references('id')->on('condominios');
            $table->smallInteger('tp')->default(0);
            $table->string('email')->unique();
            $table->string('password');
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
