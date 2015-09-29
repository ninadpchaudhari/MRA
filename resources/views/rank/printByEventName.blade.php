@extends('blank')
@section('content')
    @foreach($ranks as $rank=>$details)
    @if($rank %18 == 0)<div class="page">
        @include('templates._mssc2015')
        <h5 class="center">Ranking for {{$event->name." -- ".$event->class." ".$event->gender." ".$event->category}}</h5>
        @endif
        <table>
            @if($rank %18 == 0)
                <thead>
            <tr>
                <th data-field="rank">Rank</th>
                <th data-field="athlete_id">Competitor No.</th>
                <th data-field="shooterName">Athlete Name</th>
                <th data-field="abbreviation">Representing Unit</th>
                <th data-field="score">Score</th>
            </tr>
            </thead>
        @endif
            <tbody>
                <tr>
                    <td>{{$rank}}</td>
                    <td>{{$details->athlete_id}}</td>
                    <td>{{$details->shooterName}}</td>
                    <td>{{$details->abbreviation}}</td>
                    <td>{{$details->score}}</td>
                </tr>
            </tbody>
        </table>
        @if($rank %18 == 0)</div>@endif
    @endforeach
    @endsection