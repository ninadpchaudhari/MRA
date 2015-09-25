<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//use Illuminate\Support\Facades\Schema;

class CreateAthletesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( ! Schema::hasTable('athletes')) {
            Schema::create('athletes', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('cardNo')->unsigned()->nullable();
                $table->string('shooterID')->nllable();
                $table->integer('idCount')->unsigned()->nullable();
                $table->string('shooterName');
                $table->string('motherName')->nllable();
                $table->string('fatherName')->nllable();
                $table->string('address')->nllable();
                $table->string('city')->nllable();
                $table->integer('pin')->unsigned()->nllable();
                $table->string('education')->nllable();
                $table->string('clubOfRep')->nllable();
                $table->boolean('eventRifle');
                $table->boolean('eventPistol');
                $table->boolean('eventShotgun');
                $table->string('sex');
                $table->string('POB')->nllable();
                $table->dateTime('DOB')->nllable();
                $table->boolean('photoAvail')->nllable(); // photos are stored with shooterID.jpg
                $table->boolean('signAvail')->nllable();
                $table->string('contact')->nllable();
                $table->string('email')->nllable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('athletes');
    }
}
