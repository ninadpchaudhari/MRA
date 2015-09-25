@extends('app')
@section('content')
    <div id="app">
        <router-view></router-view>
    </div>
@endsection
    @section('footer')

        <script src="{{elixir('js/app.js')}}"></script>
@endsection
