<!-- ARS Name -->
    <div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
        {!! Form::label('name', 'ARS Name:', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'ARS Name']) !!}        
            {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
<!-- /. ARS Name -->  