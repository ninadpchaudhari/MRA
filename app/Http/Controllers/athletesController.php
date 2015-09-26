<?php

namespace App\Http\Controllers;

use App\Athlete;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;

class athletesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        //
        if($request->match_id == null ) return Athlete::all();
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('athletes.create');
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
        \App\Athlete::unguard();
        $athlete  = \App\Athlete::create($request->except(['_method', '_token']));
        \App\Athlete::reguard();

        if($athlete != null){
            Flash::message("{$athlete->shooterName} was added successfully");
            return redirect()->action('athletesController@create');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($shooterID)
    {
        //

        $shooter = Athlete::getPublicInfo($shooterID);
        var_dump($shooter);

        return $shooter;
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
