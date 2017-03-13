<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupElectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_elections', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            //FK
            $table->integer('group_id')->unsigned();
            $table->integer('election_id')->unsigned();

            //Relations
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('election_id')->references('id')->on('elections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_elections');
    }
}
