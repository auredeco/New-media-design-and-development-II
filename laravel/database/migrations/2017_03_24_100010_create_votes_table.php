<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    const TABLE = 'votes';
    const PK = 'uuid';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('voteType');
            //combinatie van userName + userID + voteID + UniqueCode
            $table->string('hashCode');
            $table->boolean('agreed')->nullable();
            $table->timestamps();
            $table->softDeletes();

            //Relation on candidates_elections table
            $table->integer('CandidateElection_id')->unsigned()->nullable();
            $table->foreign('CandidateElection_id')->references('id')->on('candidate_elections');

            //Relation on users table
            $table->integer('voter_id')->unsigned();
            $table->foreign('voter_id')->references('id')->on('voters');

            //Relation on Referendums table
            $table->integer('referendum_id')->unsigned()->nullable();
            $table->foreign('referendum_id')->references('id')->on('referendums');
        });*/

             Schema::create(static::TABLE, function (Blueprint $table) {
                 // Meta Data
                 $table->uuid(static::PK)->primary(static::PK);
                 $table->string('checksum')->nullable();
                 $table->boolean('voteType');
                 //combinatie van userName + userID + voteID + UniqueCode
                 //$table->string('hashCode');
                 $table->boolean('agreed')->nullable();
                 $table->timestamps();
                 $table->softDeletes();

                 // Foreign Keys
                 //Relation on candidates_elections table
                 $table->integer('CandidateElection_id')->unsigned()->nullable();
                 $table->foreign('CandidateElection_id')->references('id')->on('candidate_elections');

                 //Relation on Referendums table
                 $table->integer('referendum_id')->unsigned()->nullable();
                 $table->foreign('referendum_id')->references('id')->on('referendums');
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
