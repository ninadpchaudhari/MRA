<?php

namespace App\Http\Controllers;

use App\Athlete;
use App\Score;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\DebugFormatterHelper;
use Symfony\Component\HttpFoundation\Response;

class scoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return Score::all();

    }
    public function getScoresFor($match_id='*',$class='%',$gender='%',$category='%'){

        $scores = DB::table('scores')
            ->select('scores.athlete_id','scores.inTeam','scores.score','scores.final_score','scores.relay_no', 'athletes.shooterName', 'units.abbreviation')
            ->join('events', function ($join) use ($class, $match_id,$gender,$category) {
                $join->on('scores.event_id', '=', 'events.id')
                    ->where('events.match_id', '=', $match_id)
                    ->where('events.class', 'like', $class)
                    ->where('events.gender', 'like', $gender)
                    ->where('events.category', 'like', $category);
            })
            ->join('athletes', 'scores.athlete_id', '=', 'athletes.id')
            ->join('units', 'scores.representing_unit', '=', 'units.id')
            ->distinct()
            ->get();

        foreach ($scores as $score) {
            unset($score->created_at);
            unset($score->updated_at);
            unset($score->representing_unit);

        }

        return $scores;
    }
    public function indexForMatchAndClass($match_id, $class_id,Request $request)
    {
        $class=\App\Event::decodeArray()['classes'][$class_id];
        if($request->ajax()){

            $scores = $this->getScoresFor($match_id,$class);
            return \Response::json($scores, 200);
        }
        else{
            $match = \App\Match::findOrFail($match_id);
            return view('scores.indexForMatch', compact('match', 'class'));
        }

    }


    public function storeForMatchAndClass($match_id, $class_id, Request $request)
    {

        //file_put_contents(storage_path('app/request.txt'), serialize($entries));

        $class = \App\Event::decodeArray()['classes'][$class_id];
        $entries = json_decode($request->data);
        foreach ($entries as $entry) {
            //Set Relay Number
            DB::table('scores')
                ->where('athlete_id', '=', $entry->athlete_id)
                ->whereIn('event_id', function ($query) use ($match_id, $class) {
                    $query->from('events')
                        ->select('id')
                        ->where('class','=',$class)
                        ->where('match_id', '=', $match_id);
                })
                ->update(['relay_no' => $entry->relay_no,'score'=>$entry->score,'final_score'=>$entry->final_score]);
        }
        if ($request->ajax()) {
            return \Response::json($request->data);
            return \Response::json("saved data for class : ".$class);
        }



    }
    public function indexForMatchAndClassAndGender($match_id,$class_id,$gender,Request $request){
        $class=\App\Event::decodeArray()['classes'][$class_id];
        if($request->ajax()){

            $scores = $this->getScoresFor($match_id,$class,$gender);
            return \Response::json($scores, 200);
        }
        else{
            $match = \App\Match::findOrFail($match_id);
            return view('scores.indexForMatch', compact('match', 'class','gender'));
        }
    }
    public function indexForMatchAndClassAndGenderAndCategory($match_id,$class_id,$gender,$category,Request $request){
        $class=\App\Event::decodeArray()['classes'][$class_id];
        if($request->ajax()){

            $scores = $this->getScoresFor($match_id,$class,$gender,$category);
            return \Response::json($scores, 200);
        }
        else{
            $match = \App\Match::findOrFail($match_id);
            return view('scores.indexForMatch', compact('match', 'class','gender','category'));
        }
    }


    /**
     * Gives all the scores of a match
     * @param $match_id
     * @return \Illuminate\View\View
     */
    public function indexForSelectingClass($match_id)
    {
        $decodeArray = \App\Event::decodeArrayForMatch_id($match_id);
        return view('scores.indexForSelectingClass',compact('decodeArray','match_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    public function create(Request $request)
    {
        //

        if ($request->athlete_id == null) {
            return view('scores.get_athlete_id');
        } else {
            $athlete = Athlete::findOrFail($request->athlete_id);
            return view('scores.create');

        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //

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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
