<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinterestContentListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinterest_content_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userId');
            $table->string('content_id');
            $table->string('content_link');
            $table->string('tag_id');
            $table->string('type')->nullable();
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
        Schema::drop('pinterest_content_lists');
    }
}
