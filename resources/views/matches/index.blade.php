@extends('app')
@section('content')

    <h1>Matches</h1>
    <table>
        <thead>
        <tr>
            <th data-field="name"> Name </th>
            <th data-field="short_name"> Short Name </th>
            <th data-field="place"> Place </th>
            <th data-field="start_date"> Start Date </th>
            <th data-field="end_date"> End Date </th>
        </tr>
        </thead>
        <tbody>
        @foreach($matches as $match)
            <tr>
                <td><a href="{{ url('/matches',$match->id) }}"> {{ $match->name }} </a> </td>
                <td>{{ $match->short_name }}</td>
                <td>{{ $match->place }}</td>
                <td>{{ date_format($match->start_date,'d-m-Y') }}</td>
                <td>{{ date_format($match->end_date,'d-m-Y') }}</td>
                <td>
                    <button class=" btn-flat lighten-1"
                            name="action"
                            onclick="location.href = '{{ action('matchesController@edit',[$match->id]) }}'"
                            >
                        <i class="material-icons">launch</i>
                    </button>
                </td>


            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="row">
        <a href="{{ url('matches/create') }}" class="btn btn-default">Create New</a>
    </div>
    @endsection