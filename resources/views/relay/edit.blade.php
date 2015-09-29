@extends('app')
@section('content')
    <h2>Edit a Relay</h2>
    <hr>
    {!! Form::model($relay,['url'=>action('relayController@update',['match_id'=>$match_id]),'method'=>'PUT']) !!}
    {!! csrf_field() !!}
    @include('relay._form')
    {!! Form::close() !!}
    @include('flash::message')
    <div class="row">

        <form  action="{{action('relayController@destroy',['match_id'=>$match_id,'id'=>$relay->id])}}" method="post">
            {!! csrf_field() !!}
            {!! method_field('DELETE') !!}
            <div class="form-group ">
                <input type="submit" class="btn btn-warning red " value="Delete Relay" >
            </div>
        </form>
    </div>
@endsection
@section('footer')
@endsection