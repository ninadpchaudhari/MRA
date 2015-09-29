@extends('admin-app')
@section('content')
    <table>
        <thead>
        <tr>
            <th data-field="class">Class</th>
            <th data-field="gender">Gender+Type</th>
            <th data-field="relay_no">Relay Number</th>
            <th data-field="startTime">Start Time</th>
            <th data-field="endTime">End Time</th>
        </tr>
        </thead>
        <tbody>
        @foreach($relays as $relay)
            <tr>
                <td>{{ $relay->class }}</td>
                <td>{{ $relay->gender." ".$relay->type }}</td>
                <td>{{ $relay->relay_no}}</td>
                <td>{{ $relay->startTime}}</td>
                <td>{{ $relay->endTime}}</td>
                <td><button class=" btn-flat lighten-1"
                            type="submit"
                            name="action"
                            onclick="location.href = '{{ action('relayController@edit',['match_id'=>$match_id,'id'=>$relay->id]) }}'"
                            >
                        <i class="material-icons">launch</i>
                    </button></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ action('relayController@create',['match_id'=>$match_id]) }}" class="btn btn-primary">Add Relays</a>
    <a href="{{ action('matchesController@show',['match_id'=>$match_id]) }}" class="btn btn-primary">Back to Matches</a>
    @endsection
