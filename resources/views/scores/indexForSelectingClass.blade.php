@extends('admin-app')
@section('content')
    <h3>Navigate to anything</h3>
    <a href="{{ action('matchesController@show',['match_id'=>$match_id]) }}" class="btn btn-flat "> Back to Matches</a>
    <hr>

    <div class="row">
        <div class="col s6">
            <h4>Classes - Gender:</h4>
            @foreach($decodeArray['classes'] as $classKey =>$classValue)
                @foreach($decodeArray['genders'] as $genderValue)
                    <a href="{{ route('getScoresByClassAndGender',['match_id'=>$match_id,'class_id'=>$classKey,'gender'=>$genderValue]) }}"
                       class="btn btn-flat"
                            >{{$classValue." ".$genderValue}}</a>
                    <br>
                @endforeach
            @endforeach
        </div>
        <div class="col s6">
            <h4>Classes</h4>
            @foreach($decodeArray['classes'] as $classKey =>$classValue)

                    <a href="{{ route('getScoresByClass',['match_id'=>$match_id,'class_id'=>$classKey]) }}"
                       class="btn btn-flat"
                            >{{$classValue." ".$genderValue}}</a>
                    <br>

            @endforeach
        </div>
    </div>

    <hr>
    <h4>Class-Gender-Category</h4>
    @foreach($decodeArray['classes'] as $classKey =>$classValue)
        @foreach($decodeArray['genders'] as $genderValue)
            @foreach($decodeArray['categories'] as $categoryValue)
            <a href="{{ route('getScoresByClassAndGenderAndCategory',['match_id'=>$match_id,'class_id'=>$classKey,'gender'=>$genderValue,'category'=>$categoryValue]) }}"
               class="btn btn-flat"
                    >{{$classValue." ".$genderValue}}</a>
            <br>
                @endforeach
        @endforeach
    @endforeach
    @endsection
@section('footer')
    @endsection