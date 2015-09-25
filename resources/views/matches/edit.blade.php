@extends('app')
@section('content')
    <h2 class="center ">Match : {{ $match->short_name . ' ' . $match->year }}</h2>

    <div class="row">
        <form action="{{ action('matchesController@update',['id' => $match->id]) }}" method="post" >
            {{method_field('PUT')}}
            @include('matches._form',['SubmitButtonText' => 'Update Match','DeleteOption'=> 'true'])
        </form>
    </div>


    <div class="row">

        <form  action="{{action('matchesController@destroy',[$match->id])}}" method="post">
            {!! csrf_field() !!}
            {!! method_field('DELETE') !!}
            <div class="form-group ">
                <input type="submit" class="btn btn-warning red " value="Delete Match" >
            </div>
        </form>
    </div>

    @include('errors.list')
@endsection
@section('footer')
    <script src="{{elixir('js/admin.js')}}"></script>
@endsection