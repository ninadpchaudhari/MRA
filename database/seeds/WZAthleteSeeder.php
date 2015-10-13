<?php

use Illuminate\Database\Seeder;

class WZAthleteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();


        // RUN Events Seeder
        // events_seeder_mssc contains events for mssc

        DB::transaction(function () {
            $DBNAME = 'mra';
            //Inporting comMaster => Competition Data

            $records = DB::table($DBNAME . '.athletes_seeder_wz')->get();
            foreach ($records as $record) {

                $athlete = \App\Athlete::create(['shooterName'=>$record->shooterName]);

                $participation_events = explode(',',rtrim($record->match_nos,','));
                foreach($participation_events as $participation_event){

                    if((int)$participation_event < 10) $participation_event = '0'.(int)$participation_event;
                    else $participation_event = (int) $participation_event;
                    $event = \App\Event::where('name','Z-'.$participation_event)->first();
                    if($event == null){
                        echo "Unknown Event appeared".$athlete->shooterName." Event : ".$participation_event;
                        return 1;
                    }
                    \App\Score::create(['athlete_id'=>$athlete->id,'event_id'=>$event->id,'representing_unit'=>20,'cptr_no'=>$record->cptr_code]);
                }

            }
        });

        \Illuminate\Database\Eloquent\Model::reguard();
    }
}
