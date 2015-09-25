<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        factory(App\Athlete::class, 50)->create()->each(function($u) {
            $u->scores()->save(factory(App\Score::class)->make());
        });
        Model::reguard();
    }
}
