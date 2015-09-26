@extends('app')
@section('content')
    <div class="row">
        <div class="col s12">
            {!! Form::open(['method'=>'POST','action'=> 'athletesController@store']) !!}
            {!! csrf_field() !!}
            @include('athletes._form',['SubmitButtonText'=>'Enter Athlete'])
            {!! Form::close() !!}
            @include('flash::message')
        </div>
    </div>
    @endsection
@section('footer')

    @endsection