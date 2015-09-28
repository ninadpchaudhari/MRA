<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('athlete_id')->unsigned();
            $table->integer('relay_no')->unsigned()->nullable();
            $table->boolean('inTeam')->default(false);
            //$table->boolean('isWildCard');
            $table->integer('event_id')->unsigned();
            $table->decimal('score', 5, 2)->nullable();
            $table->decimal('final_score', 5, 2)->nullable(); // Finals score (not total)
            $table->integer('representing_unit')->unsigned();
            //$table->integer('verified_by_unit')->unsigned(); // 2=>By Nrai 1=>By state 0=>No
            //$table->string('rank')->nullable();
            //$table->string('record')->nullable(); // Any Record formed because of this score
            $table->timestamps();
            //$table->foreign('representing_unit')->references('id')->on('units');
            $table->foreign('athlete_id')->references('id')->on('athletes');
            $table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('scores');
    }
}

