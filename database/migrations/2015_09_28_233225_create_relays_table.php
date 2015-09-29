<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('relay_no');
            $table->string('startTime');
            $table->string('endTime');
            $table->integer('match_id');
            $table->string('class');
            $table->string('gender');
            $table->string('type')->default('ISSF');
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
        Schema::drop('relays');
    }
}
