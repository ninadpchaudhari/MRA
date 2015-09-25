@extends('app')

@section('content')

    <h1>Add a Match</h1>
    <form action="{{ action('matchesController@store') }}" method="post" >
    @include('matches._form',['SubmitButtonText' => 'Add Match'])
    </form>
    @include('errors.list')
    @endsection
@section('footer')
    <script src="{{elixir('js/admin.js')}}"></script>
    @endsection