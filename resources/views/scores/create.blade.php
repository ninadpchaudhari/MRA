@extends('app')
@section('content')
    <h2>Adding Score</h2>
    <hr>
    {{$athlete->shooterName}}
    {{$athlete->id}}
    {!! Form::open(['action'=>'scoresController@store','method'=>'POST']) !!}
    {!! csrf_field() !!}
            @include('scores._form')
    {!! Form::close() !!}

@endsection

@section('footer')
<script src="{{elixir('js/admin.js')}}"></script>
@endsection