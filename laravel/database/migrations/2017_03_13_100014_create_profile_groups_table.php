<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            //FK
            $table->integer('profile_id')->unsigned();
            $table->integer('group_id')->unsigned();

            //Relation
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->foreign('group_id')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_groups');
    }
}
