<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->dateTime('startDate');
            $table->dateTime('endDate');
            $table->boolean('isClosed');
            $table->timestamps();

            //Relation on groups table
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups');

            //Relation on votemanagers table
            $table->integer('votemanager_id')->unsigned();
            $table->foreign('votemanager_id')->references('id')->on('votemanagers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('elections');
    }
}
