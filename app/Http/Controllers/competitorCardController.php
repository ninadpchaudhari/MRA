<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class competitorCardController extends Controller
{


    public function printCompetitorCard($match_id)
    {
        $match = \App\Match::findOrFail($match_id);
        $athletes = DB::table('scores')
            ->select('scores.athlete_id')
            ->whereIn('scores.event_id',function($query) use ($match_id) {
                $query->select('id')
                    ->from('events')
                    ->where('match_id','=',$match_id);
            })

            ->distinct()
            ->orderBy('cptr_no')
            ->get();

        foreach($athletes as $athlete)
        {
            $athlete->id = $athlete->athlete_id;
            unset($athlete->athlete_id);
            $athlete->shooterName = \App\Athlete::findOrFail($athlete->id)->shooterName;
            $athlete->cptr_no = \App\Score::where('athlete_id',$athlete->id)->first()->cptr_no;

            $athlete->events = DB::table('events')
                ->select('events.*')
                ->whereIn('id',function($query) use ($athlete) {
                    $query->select('event_id')
                        ->from('scores')
                        ->where('athlete_id','=',$athlete->id);
                })
                ->get();
        }
        $i=1;
        //dd($athletes);
        //return view('competitorCard.competitorCard',compact('athletes','match','i'));
        //Supports upto 6 entries on one Competitor card
        $pdf = \PDF::loadView('competitorCard.competitorCard',compact('athletes','match','i'))
            ->setPaper('A4')
            ->setOrientation('portrait')
            ->stream('document.pdf');
        return $pdf;
    }

}
