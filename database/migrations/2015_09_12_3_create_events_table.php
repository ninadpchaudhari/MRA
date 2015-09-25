<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('match_id')->unsigned();
            $table->string('name');// N01
            $table->string('class');
            $table->string('type'); // ISSF/NR/FOREIGN_NATIONALS
            $table->string('gender'); //Men/Women/Common
            //$table->string('nat_civil');// National/Civilian/-
            $table->string('category'); // senior/junior/youth/handicapped/vertrian/services/mqs
            //$table->boolean('consider_for_qualification')->default(true);
            //$table->decimal('issf_qualification_score',6,2)->nullable(); // required qual score
            //$table->integer('nr_qualification_score')->unsigned()->nullable(); // required nr score
            $table->boolean('isDecimal')->nullable(); // true for decimal counting
            $table->decimal('max_score',6,2)->nullable(); //Maximum attainable score
            $table->timestamps();

            $table->foreign('match_id')
                ->references('id')->on('matches')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }
}
