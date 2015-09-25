@extends('../app')
@section('content')

<div class="row ">
    <div id="manage_matches" class="col s5"><a href="/matches" class="waves-effect waves-light btn">Manage Matches</a>
    <div id="manage_scores" class="col s5"><a href="/scores" class="waves-effect waves-light btn"> Scores</a>

</div>
    @endsection
@section('footer')

     <script src="{{elixir('js/admin.js')}}"></script>
@endsection