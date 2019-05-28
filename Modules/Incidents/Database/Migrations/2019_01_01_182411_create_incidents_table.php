<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',40);
            $table->text('description');
            $table->integer('criticality');
            $table->integer('type_id');
            $table->foreign('type_id')->references('id')->on('type_incidents')->onDelete('cascade');
            $table->smallInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes(); // não deleta apenas seta a data no campo deleted_at para não exibir
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incidents');
    }
}
