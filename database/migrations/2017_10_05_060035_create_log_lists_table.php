<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userId')->nullable();
            $table->string('userName')->nullable();
            $table->string('social');
            $table->string('message');
            $table->string('type');
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
        Schema::drop('log_lists');
    }
}
