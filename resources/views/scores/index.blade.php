@extends('admin-app')
@section('content')
    <h2>Participations for Match : {{ $match->short_name }} {{ $match->year }}</h2>
    <hr>
    @foreach($eventScoresArray as $eventName => $scores)
        <h3> {{ $eventName }} </h3>
        @foreach($scores as $score)
            @foreach($score as $key =>$value)
                @if($value !== null)
                {{ $key }} -- {{$value}}
                <br>
                @endif


                @endforeach
            <br>
        @endforeach
        <br>
    @endforeach


    @endsection
@section('footer')
    @endsection