<?php

namespace App\Http\Controllers;

use App\relay;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class relayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($match_id)
    {
        //
        $relays = relay::where('match_id',$match_id)->get();
        return view('relay.index',compact('relays','match_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($match_id)
    {
        //


        $decodeArray = \App\Event::decodeArrayForMatch_id($match_id);
        $classes = $decodeArray['classes'];
        $types = $decodeArray['types'];
        $gender = $decodeArray['genders'];
        return view('relay.create',compact('match_id','gender','types','classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($match_id,Request $request)
    {
        //
        $decodeArray = \App\Event::decodeArrayForMatch_id($match_id);

        $newRelay = $request->all();

        $newRelay['class'] = $decodeArray['classes'][$request->class];
        $newRelay['gender'] = $decodeArray['genders'][$request->gender];
        $newRelay['type'] = $decodeArray['types'][$request->type];

        unset($newRelay['_token']);

        $relay = relay::create($newRelay);
        $relay->save();

        Flash::message("Relay added successfully");
        return redirect(action('relayController@create',['match_id'=>$request->match_id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($match_id,$id)
    {
        //
        $decodeArray = \App\Event::decodeArrayForMatch_id($match_id);
        $classes = $decodeArray['classes'];
        $types = $decodeArray['types'];
        $gender = $decodeArray['genders'];
        $relay = \App\relay::where('id',$id)->first();

        $relay->class = array_search($relay->class,$classes);
        $relay->type = array_search($relay->type,$types);
        $relay->gender = array_search($relay->gender,$gender);


        return view('relay.edit',compact('match_id','gender','types','classes','relay'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($match_id,$id,Request $request )
    {
        //
        $decodeArray = \App\Event::decodeArrayForMatch_id($match_id);
        Model::unguard();
        $newRelay = $request->all();

        $newRelay['class'] = $decodeArray['classes'][$request->class];
        $newRelay['gender'] = $decodeArray['genders'][$request->gender];
        $newRelay['type'] = $decodeArray['types'][$request->type];

        unset($newRelay['_token']);

        $relay = relay::create($newRelay);
        $relay->save();
        Model::reguard();
        Flash::message("Relay added successfully");
        return redirect(action('relayController@create',['match_id'=>$request->match_id]));
    }
    public function printRelayByClassAndGender($match_id,$class_id,$gender){
        $relayInfo = Array();
        $athletes = Array();
        $class = \App\Event::decodeArray()['classes'][$class_id];
        $listOfRelays =
            DB::table('relays')
            ->where('match_id','=',$match_id)
                ->where('class','like',$class)
                ->where('gender','=',$gender)
            ->distinct()
            ->lists('relay_no');

        foreach($listOfRelays as $relay_no){
            //Participants in an a Relay
            $athletes[$relay_no] =
                DB::table('scores')
                    ->select('scores.athlete_id', 'athletes.shooterName', 'units.abbreviation')
                    ->join('events', function ($join) use ($class, $match_id,$gender) {
                        $join->on('scores.event_id', '=', 'events.id')
                            ->where('events.match_id', '=', $match_id)
                            ->where('events.class', 'like', $class)
                            ->where('events.gender', 'like', $gender);
                    })
                    ->join('athletes', 'scores.athlete_id', '=', 'athletes.id')
                    ->join('units', 'scores.representing_unit', '=', 'units.id')

                    ->where('scores.relay_no','=',$relay_no)
                    ->get();
            //foreach($athletes as $athlete) then athlete will have props like athlete_id,shoooterName,abbreviation

            //Array with all info regarding a particular relay
            $relayInfo[$relay_no] = \DB::table('relays')
                ->select('relays.*')
                ->where('match_id','=',$match_id)
                ->where('class','=',$class)
                ->where('gender','=',$gender)
                ->where('relay_no','=',$relay_no)
                ->first();
                //$relayInfo[$relayNo] will give all info about relay
        }
        //
        return view('relay.showRelays',compact('athletes','relayInfo','class','gender'));
        $pdf = \PDF::loadView('relay.showRelays',compact('athletes','relayInfo','class','gender'))->setPaper('a4')->setOrientation('portrait')->setOption('margin-bottom', 0)->download('download.pdf');
        return $pdf;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($match_id,$id)
    {
        //
        \App\relay::destroy($id);
        return redirect(action('relayController@index',['match_id'=>$match_id]));
    }
    public function printIndex($match_id){
        $decodeArray = \App\Event::decodeArrayForMatch_id($match_id);

        return view('relay.printIndex',compact('decodeArray','match_id'));
    }

}
