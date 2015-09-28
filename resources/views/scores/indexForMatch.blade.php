@extends('admin-app')
@section('content')
    <h2>Scores for Match : {{$match->short_name}} {{ $match->year }}</h2>
    <hr>
    @foreach($classes as $classKey=>$classValue)
        <h3>{{$classValue}}</h3>
        <div class="row">
            <div class="col s12">
                <div id="container_{{$classKey}}"></div>
            </div>
        </div>

    @endforeach
    <div class="row">
        <div class="col s12">
            <div id="example"></div>
        </div>
    </div>

    @endsection
@section('footer')
    <script>
        var getData = function(hot,class_id){
            $.get('{{ route('getScoresByClass',['match_id'=> $match->id,'class_id'=>'client_class_id']) }}'.replace("client_class_id",class_id),function(data,status){
                //console.log(data);
                hot.loadData(data);
                console.log("Request data for class_id : "+class_id);
                return data;
            });
        };
        var saveData = function (hot,class_id){
            var data = JSON.stringify(hot.getData());
            var CSRF_TOKEN = $('meta[name=csrf-token]').attr('content');
            var url = "{{route('storeScoresByClass',['match_id'=>$match->id,'class_id'=>'client_class_id'])}}".replace("client_class_id",class_id);
            $.post(url,{
                "_token":CSRF_TOKEN,
                data: data
            }).success(function(data){
                getData(hot,class_id);
                console.log("Sucess save "+ data);
            }).error(function(data){
                console.log(data);
            });

        };

        $('document').ready(function(){
            var container = new Object();
            var hot = new Object();
            @foreach($classes as $classKey=>$classValue)
                container[{{ $classKey }}] = document.getElementById('container_{{ $classKey }}');
                hot[{{$classKey}}] = new Handsontable(container[{{ $classKey }}],{
                height: 396,
                colHeaders:["Athlete_ID","Name","Unit","inTeam","score","final_score","relay_no"],
                rowHeaders: true,
                stretchH: 'all',
                columnSorting: true,
                contextMenu: true,

                     //For AutoSave
                    afterChange: function(change,source){
                       if(source === 'loadData') return;
                        saveData(this,{{$classKey}});
                    },

                columns:[
                    {data: 'athlete_id',type:'numeric'},
                    {data: 'shooterName',type:'text'},
                    {data: 'abbreviation',type:'text'},
                    {data: 'inTeam',type:'numeric'},
                    {data: 'score',type:'numeric'},
                    {data: 'final_score',type:'numeric'},
                    {data: 'relay_no',type:'numeric'},
                ],

            });

            getData(hot[{{ $classKey }}],{{$classKey}});
            @endforeach

        });

    </script>
@endsection