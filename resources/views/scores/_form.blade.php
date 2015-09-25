<div class="row">
    {{ csrf_field() }}
    <div class="form-group">
        {{Form::label('athlete_id','Athlete ID:')}}
        {{Form::number('athlet_id',null,['class'=>'form-control'])}}
    </div>
    <div class="form-group">
        {{Form::label('relay_no','Relay Number :')}}
        {{Form::number('relay_no',null,['class'=>'form-control'])}}
    </div>

</div>