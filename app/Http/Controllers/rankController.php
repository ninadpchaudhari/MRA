<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class rankController extends Controller
{
    //
    public function printIndex($match_id){
        $events = \App\Event::where('match_id',$match_id)->get();
        return view('rank.index',compact('events','match_id'));
    }
    public function printByEventName($match_id,$event_name){
        $event = \App\Event::where('name',$event_name)->where('match_id','=',$match_id)->first();
        $ranks = \DB::table('scores')
            ->select('scores.score','scores.athlete_id','units.abbreviation','athletes.shooterName')
            ->where('event_id','=',$event->id)
            ->join('athletes','athletes.id','=','scores.athlete_id')
            ->join('units','scores.representing_unit','=','units.id')
            ->orderBy('scores.score','desc');
        $maxRank = $ranks->count();
        $ranks= $ranks->get();

        return view('rank.printByEventName',compact('event','ranks','maxRank'));
    }
}
