<?php

namespace App\Http\Controllers;

use App\Match;
use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class matchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $matches = \App\Match::latest('start_date')->get();
        return view('matches.index', compact('matches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('matches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Requests\MatchRequest $request)
    {
        //

        \App\Match::create($request->all());
        return redirect('matches');
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
        $match = Match::findorFail($id);
        $events = \App\Event::where('match_id', $match->id)
            ->orderBy('name')
            ->get();
        return view('matches.show', compact('match', 'events'));
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
        $match = Match::findOrFail($id);

        return view('matches.edit', compact('match'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update($id, Requests\MatchRequest $request)
    {
        //
        debug($request->all());
        $match = Match::findOrFail($id);
        $match->update($request->all());
        $match->save();
        return redirect('matches');

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
        \App\Match::destroy($id);
        return redirect('matches');
    }
}
