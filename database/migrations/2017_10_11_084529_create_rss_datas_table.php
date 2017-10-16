<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRssDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rss_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userId');
            $table->string('title');
            $table->string('link');
            $table->string('description');
            $table->string('date')->nullable();
            $table->string('fb')->nullable();
            $table->string('tw')->nullable();
            $table->string('in')->nullable();
            $table->string('li')->nullable();
            $table->string('time')->nullable();
            $table->string('isPosted')->nullable();
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
        Schema::drop('rss_datas');
    }
}
