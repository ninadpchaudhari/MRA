@extends('admin-app')
@section('content')
    <h2>Scores for Match : {{$match->short_name}} {{ $match->year }}</h2>
    <hr>
    <div class="row">
        <div class="col s8"><h3>{{$class}}  {{$gender or ">"}}  {{$category or ">"}}</h3></div>
        <div class="col s4"><a href="{{ action('matchesController@show',['id'=>$match->id]) }}" class="btn btn-primary">Back to Matches</a></div>
    </div>

    <div class="row">
        <div class="col s12">
            <input type="text" id="searchField" type="search" placeholder="Search">
        </div>
    </div>
        <div class="row">
            <div class="col s12">
                <div id="container"></div>
            </div>
        </div>
    <div class="row">

    </div>



    @endsection
@section('footer')
    <script>
        var getData = function(hot){
            $.get($(location).attr('href'),function(data,status){
                //console.log(data);
                hot.loadData(data);
                return data;
            });
        };
        var saveData = function (hot){
            class_id = $(location).attr('pathname').split('/')[5];
            var data = JSON.stringify(hot.getData());
            var CSRF_TOKEN = $('meta[name=csrf-token]').attr('content');
            var url = "{{route('storeScoresByClass',['match_id'=>$match->id,'class_id'=>'client_class_id'])}}".replace("client_class_id",class_id);
            $.post(url,{
                "_token":CSRF_TOKEN,
                data: data
            }).success(function(data){
                getData(hot);
                console.log("Sucess save "+ data);
            }).error(function(data){
                console.log(data);
            });

        };

        $('document').ready(function(){
            var container = new Object();
            var hot = new Object();

                container = document.getElementById('container');
                hot = new Handsontable(container,{
                
                colHeaders:["Athlete_ID","Name","Unit","inTeam","score","final_score","relay_no"],
                rowHeaders: true,
                stretchH: 'all',
                columnSorting: true,
                contextMenu: true,
                afterChange:function(change,source){
                    if(source === 'loadData') return;
                    saveData(this);
                },
                    search : true,
                columns:[
                    {data: 'athlete_id',type:'numeric'},
                    {data: 'shooterName',type:'text'},
                    {data: 'abbreviation',type:'text'},
                    {data: 'inTeam',type:'numeric'},
                    {data: 'score',type:'numeric'},
                    {data: 'final_score',type:'numeric'},
                    {data: 'relay_no',type:'numeric'},
                ]

            });

            getData(hot);
            var searchField = document.getElementById('searchField');
            Handsontable.Dom.addEvent(searchField,'keyup',function(event){

                if(event.which == 13){
                    var queryResult = hot.search.query(this.value);
                    console.log("Result "+queryResult);
                    if(queryResult.length == 0 )getData(hot);
                    var newData = [];
                    $.each(queryResult,function(index,object){
                        $.each(object,function(key,value){
                            if(key == "row") {
                                var formatData={};
                                var data = hot.getDataAtRow(value);
                                formatData['athlete_id'] = data[0];
                                formatData['shooterName'] = data[1];
                                formatData['abbreviation'] = data[2];
                                formatData['inTeam'] = data[3];
                                formatData['score'] = data[4];
                                formatData['final_score'] = data[5];
                                formatData['relay_no'] = data[6];

                                newData.push(formatData);
                            }
                        });

                    });

                    hot.loadData(newData);

                    hot.render();
                    console.log(newData);
                }

            });



        });

    </script>
@endsection