<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class eventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Model::unguard();
         DB::transaction(function () {
            $DBNAME = 'mra';
            //Inporting comMaster => Competition Data

            $records = DB::table($DBNAME . '.events_seeder_wz')->get();
            foreach ($records as $record) {
                \App\Event::create((array)$record);
                print_r($record);
            }

        });
        $this->command->info("Seeding Events");
        DB::transaction(function () {
            $DBNAME = 'mra';
            //Inporting comMaster => Competition Data

            $records = DB::table($DBNAME . '.events_seeder_mssc')->get();
            foreach ($records as $record) {
                \App\Event::create((array)$record);
                print_r($record);
            }
        });

        Model::reguard();
    }
}
