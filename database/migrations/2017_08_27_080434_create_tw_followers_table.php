<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tw_followers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userId');
            $table->string('username');
            $table->string('followers');
            $table->string('profile_pic');
            $table->string('is_follow');
            $table->string('conversions');
            $table->string('profile_link');
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
        Schema::drop('tw_followers');
    }
}
