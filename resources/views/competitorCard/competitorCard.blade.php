@extends('blank')
@section('head')
    <style>
    </style>
    @endsection
@section('content')
    @foreach($athletes as $athlete)
        <article style="border:1pt solid black;
                        width:28.3cm;
                        height:19.5cm
        ">
            <div class="row" style="margin-bottom: 0px">
                <div class="col s2" style="margin-top: 30px;">
                    <img src="{{ url('images/mra_logo.jpg') }}" alt="MRA Logo" height="90px">
                </div>
                <div class="col s10">
                    <h3 class="center">Maharashtra Rifle Association</h3>
                    <h3 class="center">COMPETITOR CARD</h3>
                </div>
            </div>
            <hr>
            <div class="row ">
                <div class="col s8">
                    <blockquote>
                        <h5>Name of Shooter : {{$athlete->shooterName}}</h5>
                        <h5>Competitor No.  : {{ $athlete->cptr_no }}</h5>
                        <h5>Competition : {{ $match->name}}</h5>
                    </blockquote>

                </div>

                    <div class="col s3 offset-s1" >
                        <p>-</p>
                        <h5>Affix Photo</h5>
                        <p>-</p>
                    </div>


            </div>
            <div class="row">
                <div class="col s12">
                    <h4>Participating Events : </h4>
                    @foreach($athlete->events as $index => $event)
                        <div class="row" style="margin-bottom: 0px">

                                <div class="col s1" >
                                    <h5>{{$index+1}} -- </h5>
                                </div>
                                <div class="col s11" >
                                    <h5>{{$event->name .' '.$event->class.' '.$event->type.' '.$event->gender.' '.$event->category}}</h5>
                                </div>
                            <hr style="width:82%">
                        </div>


                    @endforeach
                </div>

            </div>
        </article>
    @if($i %2 == 0)
        <div style="page-break-after: always;"></div>
        @endif
       {{ $i++ }}
    @endforeach
    @endsection