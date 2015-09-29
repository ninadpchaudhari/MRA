@extends('app')
@section('content')

<h1>Match : {{ $match->short_name }}</h1>
    <div class="row">
        <div class="col s6">ID : </div> <div class="col s6">{{ $match->id }}</div>
        <div class="col s6">Name :</div><div class="col s6">{{ $match->name }}</div>
        <div class="col s6">Place :</div><div class="col s6">{{ $match->place }}</div>
        <div class="col s6">Start Date :</div> <div class="col s6">{{ $match->start_date }}</div>
        <div class="col s6">End Date :</div><div class="col s6">{{ $match->end_date }}</div>
    </div>
    <div class="row">
        <a href="{{action('matchesController@edit',['id' => $match->id])}}"
           class="btn btn-default">
            Edit Match
        </a>
        <a href="{{route('indexForSelectingClass',['match_id'=>$match->id])}}"
           class="btn btn-default">
            Manage Shooters
        </a>
        <a href="{{action('relayController@index',['match_id'=>$match->id])}}"
           class="btn btn-default">
            Manage Relays
        </a>
        <a href="{{action('relayController@printIndex',['match_id'=>$match->id])}}"
           class="btn btn-default">
            Print Relays
        </a>

    </div>
<br>
@include('matches._event_list')

    <div class="row">
        <div class="col s6">
            <a href="{{action('eventsController@create',['match_id'=>$match->id])}}" class="btn btn-default">Add Event</a>
        </div>
    </div>
@endsection