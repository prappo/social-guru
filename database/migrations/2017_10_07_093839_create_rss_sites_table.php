<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRssSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rss_sites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userId');
            $table->string('site');
            $table->string('title')->nullable();
            $table->string('link')->nullable();
            $table->string('description')->nullable();
            $table->string('time')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->nullable();
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
        Schema::drop('rss_sites');
    }
}
