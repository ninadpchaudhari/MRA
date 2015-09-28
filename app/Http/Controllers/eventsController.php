<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
//use DebugBar\DebugBar;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class eventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    // Gives types and classes which player has played match earlier in 2 years
    public function getPlayableClassType($shooterID, $matchYear)
    {
        $playableArray['types'] = Array();
        $playableArray['classes'] = Array();
        $minYear = $matchYear - 2;
        $eventTypeClass =
            DB::table('scores')
                ->select('events.type', 'events.class')
                ->join('events', 'events.id', '=', 'scores.event_id')
                ->join('matches', function ($join) use ($minYear) {
                    $join->on('events.match_id', '=', 'matches.id')
                        ->where('matches.year', '>=', $minYear);
                })
                ->where(['scores.shooterID' => $shooterID])
                ->distinct()
                ->get();

        foreach ($eventTypeClass as $eventTypeClass_1) {
            $playableArray['types'][] = $eventTypeClass_1->type;
            $playableArray['classes'][] = $eventTypeClass_1->class;
        }

        return $playableArray;
    }

    public function getPlayableClass($shooterID, $matchYear)
    {

        $playableArray['classes'] = Array();
        $minYear = $matchYear - 2;
        $eventTypeClass =
            DB::table('scores')
                ->select('events.class')
                ->join('events', 'events.id', '=', 'scores.event_id')
                ->join('matches', function ($join) use ($minYear) {
                    $join->on('events.match_id', '=', 'matches.id')
                        ->where('matches.year', '>=', $minYear);
                })
                ->where(['scores.shooterID' => $shooterID])
                ->distinct()
                ->get();

        foreach ($eventTypeClass as $eventTypeClass_1) {
            $playableArray['classes'][] = $eventTypeClass_1->class;
        }

        return $playableArray;
    }

    public function getPlayableGender($athleteSex)
    {
        $playableArray = Array();
        //Common events can always be played
        $playableArray[] = 'Common';

        if (strcmp($athleteSex, 'MEN') == 0) {
            $playableArray[] = 'Men';
        } elseif (strcmp($athleteSex, 'WOMEN') == 0) {
            $playableArray[] = 'Women';
        } else dd('Error in getting PlayableGender' . $playableArray);
        return $playableArray;
    }

    public function getPlayableCategories($athlete, $match)
    {

        $age = abs($match->year - $athlete->DOB->year);
        if ($age > 150 || $age < 10) {
            echo "Age Out of Bounds -- from Controller";
            dd($age);
        }
        $playableArray['categories'] = \App\Event::decodeArray()['categories'];

        if ($age > 21) {
            //Senior Category Player
            return array_diff($playableArray['categories'], array('Junior', 'Youth'));
        } elseif ($age < 21 && $age > 18) {
            //Junior Category Player
            return array_diff($playableArray['categories'], array('Youth'));
        } elseif ($age < 18) {
            //Youth Category Player
            return $playableArray['categories']; // no change
        }

    }

    public function getMaxIssfScore($shooterID, $match)
    {
        $minYear = $match->year - 2;
        $matchesIDs = DB::table('matches')
            ->select('matches.id')
            ->where('matches.id', '>=', $minYear)
            ->get();
        $selectedMatches = Array();
        foreach ($matchesIDs as $matchesID) {
            $selectedMatches[] = $matchesID->id;
        }
        //dd($selectedMatches);
        $maxIssfScore = DB::table('scores')
            ->join('events', function ($join) use ($minYear, $selectedMatches) {
                $join->on('events.id', '=', 'scores.event_id')
                    ->where('events.consider_for_qualification', '=', 1)
                    ->whereIn('events.match_id', $selectedMatches);


            })
            ->where('scores.shooterID', $shooterID)
            ->max('scores.score');;
        dd($maxIssfScore);
        return $maxIssfScore;

    }

    public function athleteCompatibleEvents($match_id, $shooterID)
    {
        $shooterID = (string)$shooterID;
        $athlete = \App\Athlete::where('shooterID', $shooterID)->first();
        $match = \App\Match::findOrFail($match_id);

        //setting types and classes
        $playableArray = Array();

        $playableArray = $this->getPlayableClass($shooterID, $match->year); // as 2 keys, the function itself returns keys value pairs
        $playableArray['types'] = \App\Event::decodeArray()['types'];
        $playableArray['categories'] = $this->getPlayableCategories($athlete, $match);
        $playableArray['genders'] = $this->getPlayableGender($athlete->sex);
        $playableArray['nat_civil'] = \App\Event::decodeArray()['nat_civil'];
        dd($playableArray);
        //$playableArray['max_issf_score'] = $this->getMaxIssfScore($shooterID,$match,$playableArray['']);
        $compatibleEvents =
            DB::table('events')
                ->select('events.*')
                ->where('match_id', '=', $match_id)
                ->whereIn('class', $playableArray['classes'])
                ->whereIn('type', $playableArray['types'])
                ->whereIn('gender', $playableArray['genders'])
                ->whereIn('nat_civil', $playableArray['nat_civil'])
                ->whereIn('category', $playableArray['categories'])
                ->get();
        return $compatibleEvents;
        foreach ($compatibleEvents as $compatibleEvent) {

        }


        /*
         *
         $masterEvents = DB::table('events')
            ->select('events.*')
            ->join('events', function ($join) use ($compatibilityArray) {
                $join->on('events.id', '=', 'scores.event_id')
                    ->whereIn('events.type', $compatibilityArray['types'])
                    ->whereIn('events.gender', $compatibilityArray['genders'])
                    ->whereIn('events.nat_civil', $compatibilityArray['nat_civil'])
                    ->whereIn('events.category', $compatibilityArray['categories'])
                    ->where('scores.score', '>=', 'events.issf_qualification_score');
            })
            ->get();
        */

    }

    public function index()
    {
        $events = \App\Event::all();
        return view('matches._event_list', compact('events'));
    }

    public function matchIndex($match_id)
    {
        //
        $match = \App\Match::findOrFail($match_id);
        $events = \App\Event::find($match_id);
        return view('events.matchIndex', compact('match', 'events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        //
        $match_id = $request->match_id;
        $decodeArray = \App\Event::decodeArray();

        //app('debugbar')->info($match_id);

        $match = \App\Match::findOrFail($match_id);
        return view('events.create', compact('match_id', 'match', 'decodeArray'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Requests\eventsRequest $request)
    {
        //
        //app('debugbar')->info($request->all());
        if (!$request->has('isDecimal')) {
            $request->merge(['isDecimal' => false]);
        } else $request->merge(['isDecimal' => true]);

        \App\Event::create($request->all());

        return redirect(action('matchesController@show', [$request->get('match_id')]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $event = \App\Event::findOrFail($id);
        $decodeArray = \App\Event::decodeArray();

        return view('events.edit', compact('event', 'decodeArray'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update($id, Requests\eventsRequest $request)
    {
        //
        if (!$request->has('isDecimal')) {
            $request->merge(['isDecimal' => false]);
        } else $request->merge(['isDecimal' => true]);

        $event = \App\Event::findOrFail($id);
        $event->update($request->all());

        $event->save();

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($event_id)
    {
        //
        app('debugbar')->info('Destroying' . $event_id);
        \App\Event::destroy($event_id);
        return Redirect::back();
    }
}
