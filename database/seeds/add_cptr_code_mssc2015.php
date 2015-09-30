<?php

use Illuminate\Database\Seeder;

class cptrCodeMssc extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::transaction(function () {
            $DBNAME = 'mra';
            //Inporting comMaster => Competition Data

            $records = DB::table($DBNAME . '.')->get();
            foreach ($records as $record) {

                $athlete = \App\Athlete::create(['shooterName'=>$record->shooterName,'DOB'=>\Carbon\Carbon::parse($record->dob)]);

                $unit = \App\Unit::where('abbreviation','=',$record->unit)->first();

                if($unit == null)
                    $unit = \App\Unit::create(['abbreviation'=>$record->unit]);

                $participation_events = explode(',',rtrim($record->match_nos,','));
                foreach($participation_events as $participation_event){

                    if((int)$participation_event < 10) $participation_event = '0'.(int)$participation_event;
                    else $participation_event = (int) $participation_event;
                    $event = \App\Event::where('name','M'.$participation_event)->first();
                    if($event == null){
                        echo "Unknown Event appeared".$athlete->shooterName." Event : ".$participation_event;
                        return 1;
                    }
                    \App\Score::create(['athlete_id'=>$athlete->id,'event_id'=>$event->id,'representing_unit'=>$unit->id]);
                }


            }
        });
    }
}
