@extends('blank')
@section('content')


        @foreach($athletes as $relay_no => $manyAthletes)
            <div class="page">
                @include('templates._mssc2015')
            <h5 class="center">Details for {{ $class.' '. $gender }}</h5>

                <div class="row">
                    <div class="col s2">Relay No.: {{$relay_no}}</div>
                    <div class="col s2">Start Time :</div>
                    <div class="col s3">{{$relayInfo[$relay_no]->startTime}}</div>
                    <div class="col s2">End Time :</div>
                    <div class="col s3">{{$relayInfo[$relay_no]->endTime}}</div>
                </div>
                <table class="bordered">
                    <thead>
                    <tr>
                        <th data-field="athlete_id">Competitor ID</th>
                        <th data-field="shooterName">Athlete's Name</th>
                        <th data-field="abbreviation">Representing Unit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($manyAthletes as $singleAthlete)
                        <tr>
                            <td>{{$singleAthlete->athlete_id}}</td>
                            <td>{{$singleAthlete->shooterName}}</td>
                            <td>{{$singleAthlete->abbreviation}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        @endforeach


    @endsection
@section('footer')
    @endsection