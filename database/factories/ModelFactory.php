<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Athlete::class, function (Faker\Generator $faker) {
    return [
        'shooterName' => $faker->name,
        'eventRifle' => $faker->randomElements(array('0','1')),
        'eventPistol' => $faker->randomElements(array('0','1')),
        'eventShotgun' => $faker->randomElements(array('0','1')),
        'sex' => $faker->randomElements(['Men','Women']),
        'DOB'=> $faker->dateTimeThisCentury
    ];
});
$factory->define(App\Score::class, function (Faker\Generator $faker) {
    return [
        'relay_no' => $faker->randomElements(array('1','2','3')),
        'event_id' => $faker->randomElements(array('1','2','3')),
        'score' => $faker->randomFloat($nbMaxDecimals = 2, $min = 200, $max = 1200),
        'representing_unit' => $faker->randomElements(array('1','2','3'))
    ];
});

$factory->define(App\Unit::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->state,
        'abbreviation' => $faker->state,
    ];
});