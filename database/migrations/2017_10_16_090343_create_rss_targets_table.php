<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRssTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rss_targets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userId');
            $table->string('site');
            $table->string('fbPageId');
            $table->string('fbPageName');
            $table->string('fbGroupId');
            $table->string('fbGroupName');

            $table->string('tw');
            $table->string('liCompanyId');
            $table->string('liCompanyName');
            $table->string('in');
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
        Schema::drop('rss_targets');
    }
}
