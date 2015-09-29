@extends('app')
@section('content')
<h2>Add a Relay</h2>
<hr>
    {!! Form::open(['url'=>action('relayController@store',['match_id'=>$match_id]),'method'=>'POST']) !!}
    {!! csrf_field() !!}
    @include('relay._form')
    {!! Form::close() !!}
@include('flash::message')
    @endsection
@section('footer')
    @endsection