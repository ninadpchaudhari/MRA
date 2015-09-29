{!! Form::hidden('match_id',$match_id) !!}
<div class="form-group">
    {!! Form::label('class','Class') !!}
    {!! Form::select('class',$classes,null,['class'=>'form-control browser-default']) !!}
</div>
<div class="form-group">
    {!! Form::label('gender','Gender') !!}
    {!! Form::select('gender',$gender,null,['class'=>'form-control browser-default']) !!}
</div>
<div class="form-group">
    {!! Form::label('type','Type') !!}
    {!! Form::select('type',$types,'ISSF',['class'=>'form-control browser-default']) !!}
</div>
<div class="form-group">
    {!! Form::label('relay_no','Detail Number :') !!}
    {!! Form::number('relay_no',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('startTime','Start Time') !!}
    {!! Form::text('startTime',"29/Sep/2015 -- 16:00",['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('endTime','End Time') !!}
    {!! Form::text('endTime',"29/Sep/2015 -- 17:00",['class'=>'form-control']) !!}
</div>
{!! Form::submit('Save',['class'=>'btn btn-primary']) !!}
<br>

    <a href="{{ action('matchesController@show',['match_id'=>$match_id]) }}" class="btn btn-flat"><-Go Back to Matches</a>
