<div class="row">
    <!-- Regulars -->
    <div class="col-sm-4">
        <div class="form-group {{ $errors->has('regulars') ? 'has-error' : null }}">
                {!! Form::label('regulars', 'Regulars:', ['class'=>'col-sm-2 control-label']) !!}
                {!! Form::input('number', 'regulars', null, ['class'=>'form-control', 'placeholder'=>'Regulars']) !!}        
                {!! $errors->first('regulars', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
    <!-- /. Regulars -->

    <!-- Nightly -->
    <div class="col-sm-4">
        <div class="form-group {{ $errors->has('nightly') ? 'has-error' : null }}">
                {!! Form::label('nightly', 'Nightly:', ['class'=>'col-sm-2 control-label']) !!}
                {!! Form::input('number', 'nightly', null, ['class'=>'form-control', 'placeholder'=>'Nightly']) !!}        
                {!! $errors->first('nightly', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
    <!-- /. Nightly -->

    <!-- Holidays -->
    <div class="col-sm-4">
        <div class="form-group {{ $errors->has('holidays') ? 'has-error' : null }}">
                {!! Form::label('holidays', 'Holidays:', ['class'=>'col-sm-2 control-label']) !!}
                {!! Form::input('number', 'holidays', null, ['class'=>'form-control', 'placeholder'=>'Holidays']) !!}        
                {!! $errors->first('holidays', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
    <!-- /. Holidays -->

    <!-- Training -->
    <div class="col-sm-4">
        <div class="form-group {{ $errors->has('training') ? 'has-error' : null }}">
                {!! Form::label('training', 'Training:', ['class'=>'col-sm-2 control-label']) !!}
                {!! Form::input('number', 'training', null, ['class'=>'form-control', 'placeholder'=>'Training']) !!}        
                {!! $errors->first('training', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
    <!-- /. Training -->

    <!-- Overtime -->
    <div class="col-sm-4">
        <div class="form-group {{ $errors->has('overtime') ? 'has-error' : null }}">
                {!! Form::label('overtime', 'Overtime:', ['class'=>'col-sm-2 control-label']) !!}
                {!! Form::input('number', 'overtime', null, ['class'=>'form-control', 'placeholder'=>'Overtime']) !!}        
                {!! $errors->first('overtime', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
    <!-- /. Overtime -->
</div>

