<?php

namespace App\Http\Controllers;

use App\Athlete;
use App\Score;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class scoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        //
        if($request->match_id == null ) return Score::all();
        $match = \App\Match::findOrFail($request->match_id);
        $event_ids = \App\Event::where('match_id',$request->match_id);
        $scores = \App\Score::whereIn('event_id',$event_ids);
        return view('scores.index',compact('scores','match'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    public function create(Request $request)
    {
        //

        if($request->athlete_id == null){
            return  view('scores.get_athlete_id');
        }
        else
        {
            $athlete = Athlete::findOrFail($request->athlete_id);
            return view('scores.create');

        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
