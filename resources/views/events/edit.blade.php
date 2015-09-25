@extends('app')
@section('content')
    <h2 class="center ">Event : {{ $event->id  }}</h2>

    <div class="row">
        <form action="{{ action('eventsController@update',['id' => $event->id]) }}" method="post" >
            <input type="hidden" value="{{$event->id}}" name="$event_id">
            {{method_field('PUT')}}
            @include('events._form',['SubmitButtonText' => 'Update Event','DeleteOption'=> 'true'])
        </form>
    </div>


    <div class="row">

        <form  action="{{action('eventsController@destroy',[$event->id])}}" method="post">
            {!! csrf_field() !!}
            {!! method_field('DELETE') !!}
            <div class="form-group ">
                <input type="submit" class="btn btn-warning red " value="Delete Event" >
            </div>
        </form>
    </div>

    @include('errors.list')
@endsection
@section('footer')
    <script src="{{elixir('js/admin.js')}}"></script>
@endsection