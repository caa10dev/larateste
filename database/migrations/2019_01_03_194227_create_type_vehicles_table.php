<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('apartment_id')->unsigned()->nullable();
            $table->foreign('apartment_id')->references('id')->on('apartments');
            $table->integer('tower_id')->unsigned()->nullable();
            $table->foreign('tower_id')->references('id')->on('towers');
            $table->string('plate',8);
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
        Schema::dropIfExists('type_vehicles');
    }
}
