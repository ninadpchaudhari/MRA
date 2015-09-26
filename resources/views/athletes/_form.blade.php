<div class="form-group">
    {!! Form::label('shooterName','Name') !!}
    {!! Form::text('shooterName',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('sex','Gender') !!}
    {!! Form::select('sex',['Men'=>'Men','Women'=>'Women'],null,['class'=>'form-control browser-default']) !!}
</div>
<div class="form-control">
    {!! Form::label('DOB','Date of Birth') !!}
    {!! Form::date('DOB',null,['class'=>'form-control']) !!}
</div>
<div class="form-control">
    {!! Form::submit($SubmitButtonText,['class'=> 'btn btn-primary form-control']) !!}
</div>