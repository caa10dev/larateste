<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentsApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents_apartments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('apartment_id')->unsigned()->nullable();
            $table->foreign('apartment_id')->references('id')->on('apartments');
            $table->integer('tower_id')->unsigned()->nullable();
            $table->foreign('tower_id')->references('id')->on('towers');
            $table->integer('owner_id')->unsigned()->nullable();
            $table->foreign('owner_id')->references('id')->on('residents');
            $table->integer('lodger_id')->unsigned()->nullable();
            $table->foreign('lodger_id')->references('id')->on('residents');
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
        Schema::dropIfExists('residents_apartments');
    }
}
