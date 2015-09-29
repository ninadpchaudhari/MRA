@extends('admin-app')
@section('content')
<h3>Print Relays</h3>
<a href="{{ action('matchesController@show',['match_id'=>$match_id]) }}" class="btn btn-flat "> Back to Matches</a>
<hr>
    <div class="row">
        <div class="col s6">
            <h4>Classes - Gender:</h4>
            @foreach($decodeArray['classes'] as $classKey =>$classValue)
                @foreach($decodeArray['genders'] as $genderValue)
                    <a href="{{ route('getRelaysByClassAndGender',['match_id'=>$match_id,'class_id'=>$classKey,'gender'=>$genderValue]) }}"
                       class="btn btn-flat"
                            >{{$classValue." ".$genderValue}}</a>
                    <br>
                @endforeach
            @endforeach
        </div>
    </div>
    @endsection
