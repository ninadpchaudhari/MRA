@extends('admin-app')
@section('content')
    <h3>Print Rankings</h3>
    <a href="{{ action('matchesController@show',['match_id'=>$match_id]) }}" class="btn btn-flat "> Back to Matches</a>
    <hr>
    <div class="row">
        @foreach($events as $event)
            <div class="col s6">
                <a href="{{ route('printRankingByEventName',['match_id'=>$match_id,'event_name'=>$event->name]) }}"
                        >
                    {{$event->name." -- ".$event->class." ".$event->gender." ".$event->category}}</a>
            </div>
            @endforeach


    </div>
    @endsection
@section('footer')
    @endsection
