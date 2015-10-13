<?php

use Illuminate\Database\Seeder;

class WZEventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \Illuminate\Database\Eloquent\Model::unguard();

        DB::transaction(function () {
            $DBNAME = 'mra';
            //Inporting comMaster => Competition Data

            $records = DB::table($DBNAME . '.events_seeder_wz')->get();
            foreach ($records as $record) {
                $event = new\App\Event();
                $event->match_id = $record->match_id;
                $event->name = $record->name;
                $event->class = $record->class;
                $event->type = $record->type;
                $event->gender = $record->gender;
                $event->category = $record->category;
                $event->isDecimal = $record->isDecimal;
                $event->save();

            }
        });

        \Illuminate\Database\Eloquent\Model::reguard();
    }
}
