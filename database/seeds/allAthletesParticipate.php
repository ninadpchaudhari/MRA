<?php

use Illuminate\Database\Seeder;

class allAthletesParticipate extends Seeder
{
    /**
     * Run the database seeds.
     * Seed for making all athletes to play all events => populating the Score Model
     * @return void
     */
    public function run()
    {
        //
        \Illuminate\Database\Eloquent\Model::unguard();
        $athletes = \App\Athlete::all();
        $events = \App\Event::all();
        foreach ($athletes as $athlete) {
            foreach ($events as $event) {
                $scoreArray['athlete_id'] = $athlete->id;
                $scoreArray['event_id'] = $event->id;
                \App\Score::create($scoreArray);
            }
        }
        \Illuminate\Database\Eloquent\Model::reguard();


    }
}
