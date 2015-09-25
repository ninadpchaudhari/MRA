@extends('app')
@section('content')
    <h2>Enter Atlhete ID</h2>
    <hr>
    {!! Form::open(['action'=>'scoresController@create','method'=>'GET'])!!}
    {{ csrf_field() }}

        <div class="form-group">
            {!! Form::label('athlete_id','Athlete ID:') !!}
            {!! Form::number('athlete_id',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group right">
            {!! Form::submit('Submit',['class'=> 'btn btn-primary form-control']) !!}
        </div>


    {!! Form::close() !!}
    @endsection
@include('errors.list')
{{-- Why does adding a ";" in front of (errors.list) change the navigation bar size ??--}}
@section('footer')
    <script src="{{elixir('js/admin.js')}}"></script>
    @endsection
