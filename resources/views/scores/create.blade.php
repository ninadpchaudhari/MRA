@extends('app')
@section('content')
    <h2>Adding Score</h2>
    <hr>
    {!! Form::open(['action'=>'scoresController@store','method'=>'POST']) !!}
            @include('scores._form');
    {!! Form::close() !!}

@endsection

@section('footer')
<script src="{{elixir('js/admin.js')}}"></script>
@endsection