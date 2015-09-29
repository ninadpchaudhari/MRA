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
        if (!Schema::hasTable('athletes')) {
            Schema::create('athletes', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('cardNo')->unsigned()->nullable();
                $table->string('shooterID')->nullable();
                $table->integer('idCount')->unsigned()->nullable();
                $table->string('shooterName');
                $table->string('motherName')->nullable();
                $table->string('fatherName')->nullable();
                $table->string('address')->nullable();
                $table->string('city')->nullable();
                $table->integer('pin')->unsigned()->nullable();
                $table->string('education')->nullable();
                $table->string('clubOfRep')->nullable();
                $table->boolean('eventRifle');
                $table->boolean('eventPistol');
                $table->boolean('eventShotgun');
                $table->string('sex');
                $table->string('POB')->nullable();
                $table->dateTime('DOB')->nullable();
                $table->boolean('photoAvail')->nullable(); // photos are stored with shooterID.jpg
                $table->boolean('signAvail')->nullable();
                $table->string('contact')->nullable();
                $table->string('email')->nullable();
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
