<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_votes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            //FK
            $table->integer('vote_id')->unsigned();
            $table->integer('profile_id')->unsigned();

            //Relations
            $table->foreign('vote_id')->references('id')->on('votes');
            $table->foreign('profile_id')->references('id')->on('profiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_votes');
    }
}
