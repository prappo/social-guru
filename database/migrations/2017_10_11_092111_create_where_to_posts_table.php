<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhereToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('where_to_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userId');
            $table->string('link');
            $table->string('fb');
            $table->string('tw');
            $table->string('in');
            $table->string('li');
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
        Schema::drop('where_to_posts');
    }
}
