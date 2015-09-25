@extends('app')

@section('content')

    <h3>Adding Event for : {{ $match->short_name }} {{$match->year}}</h3>
    <form action="{{ action('eventsController@store')  }}" method="POST">
        @include('events._form',['SubmitButtonText' => 'Add Event'])
    </form>
    @include('errors.list')
@endsection
@section('footer')
    <script src="{{elixir('js/admin.js')}}"></script>
@endsection