@extends('admin-app')
@section('content')
    <h2>Scores for Match : {{$match->short_name}} {{ $match->year }}</h2>
    <hr>
    @foreach($classes as $classKey=>$classValue)
        <h3>{{$classValue}}</h3>
        <div id="info_{{$classKey}}"></div>
    @endforeach
    <div class="row">
        <div class="col s12">
            <div id="example"></div>
        </div>
    </div>

    @endsection
@section('footer')
    <script>

        $('document').ready(function(){
            var allData = function(){
                data = JSON.parse("[[51,1,null,0,51,null,null,0],[113,2,null,0,51,null,null,0],[175,3,null,0,51,null,null,0],[237,4,null,0,51,null,null,0],[299,5,null,0,51,null,null,0],[361,6,null,0,51,null,null,0],[423,7,null,0,51,null,null,0],[485,8,null,0,51,null,null,0],[547,9,null,0,51,null,null,0],[609,10,null,0,51,null,null,0],[671,11,null,0,51,null,null,0],[733,12,null,0,51,null,null,0],[795,13,null,0,51,null,null,0],[857,14,null,0,51,null,null,0],[919,15,null,0,51,null,null,0]]");
                console.log(data);
                return data;
                $.get('{{ route('getScoresByClass',['match_id'=>1,'class_id'=>1]) }}',function(data,status){
                    //alert('data :'+ data +'\nStatus : '+status);
                    data = JSON.parse("[[51,1,null,0,51,null,null,0],[113,2,null,0,51,null,null,0],[175,3,null,0,51,null,null,0],[237,4,null,0,51,null,null,0],[299,5,null,0,51,null,null,0],[361,6,null,0,51,null,null,0],[423,7,null,0,51,null,null,0],[485,8,null,0,51,null,null,0],[547,9,null,0,51,null,null,0],[609,10,null,0,51,null,null,0],[671,11,null,0,51,null,null,0],[733,12,null,0,51,null,null,0],[795,13,null,0,51,null,null,0],[857,14,null,0,51,null,null,0],[919,15,null,0,51,null,null,0]]");
                    console.log(data);
                    return data;
                });
            };
            var container = document.getElementById('example');;
            var hot = new Handsontable(container,{
                data: allData(),
                height: 396,
                colHeaders:["id","athlete_id","relay_no","inTeam","event_id","score","final_score","representing_unit"],
                rowHeaders: true,
                stretchH: 'all',
                columnSorting: true,
                contextMenu: true,
                columns:[
                    {data: 0,type:'numeric'},
                    {data: 1,type:'numeric'},
                    {data: 2,type:'text'},
                    {data: 3,type:'numeric'},
                    {data: 4,type:'numeric'},
                    {data: 5,type:'text'},
                    {data: 6,type:'text'},
                    {data: 7,type:'numeric'},
                ]
            });
        });

    </script>
@endsection