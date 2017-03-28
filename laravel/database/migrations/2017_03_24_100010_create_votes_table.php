<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('voteType');
            //combinatie van userName + userID + voteID + UniqueCode
            $table->string('hashCode');
            $table->timestamps();

            //Relation on candidates_elections table
            $table->integer('CandidateElection_id')->unsigned();
            $table->foreign('CandidateElection_id')->references('id')->on('candidate_elections');

            //Relation on users table
            $table->integer('voter_id')->unsigned();
            $table->foreign('voter_id')->references('id')->on('voters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
    }
}
