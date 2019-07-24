<div class="row">
    <div class="col-sm-6">
        <!-- Name -->
        <div class="form-group {{ $errors->has('employee_id') ? 'has-error' : null }}">
            {!! Form::label('employee_id', 'Name:', ['class'=>'']) !!}
            {!! Form::select('employee_id', $shift->employeesList->pluck('full_name', 'id'), null, ['class' => 'form-control']) !!}
            {!! $errors->first('employee_id', '<span class="text-danger">:message</span>') !!}
        </div>
        <!-- /. Name -->
    </div>

    <div class="col-sm-3">
        <!-- Start -->
        <div class="form-group {{ $errors->has('start_at') ? 'has-error' : null }}">
            {!! Form::label('start_at', 'Start:', ['class'=>'']) !!}
            {!! Form::input('time', 'start_at', null, ['class'=>'form-control', 'placeholder'=>'Start']) !!}
            {!! $errors->first('start_at', '<span class="text-danger">:message</span>') !!}
        </div>
        <!-- /. Start -->
    </div>

    <div class="col-sm-3">
         <!-- End -->
        <div class="form-group {{ $errors->has('end_at') ? 'has-error' : null }}">
            {!! Form::label('end_at', 'End:', ['class'=>'']) !!}
            {!! Form::input('time', 'end_at', null, ['class'=>'form-control', 'placeholder'=>'End']) !!}
            {!! $errors->first('end_at', '<span class="text-danger">:message</span>') !!}
        </div>
        <!-- /. End -->
    </div>
</div>

<div class="row">
    <div class="col-sm-2">
        <div class="form-group {{ $errors->has('mondays') ? 'has-error' : null }}">
            {!! Form::label('mondays', 'Mondays:', ['class'=>'']) !!}
            {!! Form::input('number', 'mondays', 0, ['class'=>'form-control', 'placeholder'=>'Mondays', 'min' => 0, 'max' => 16]) !!}
            {!! $errors->first('mondays', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group {{ $errors->has('tuesdays') ? 'has-error' : null }}">
            {!! Form::label('tuesdays', 'Tuesdays:', ['class'=>'']) !!}
            {!! Form::input('number', 'tuesdays', 0, ['class'=>'form-control', 'placeholder'=>'Tuesdays', 'min' => 0, 'max' => 16]) !!}
            {!! $errors->first('tuesdays', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group {{ $errors->has('wednesdays') ? 'has-error' : null }}">
            {!! Form::label('wednesdays', 'Wednesdays:', ['class'=>'']) !!}
            {!! Form::input('number', 'wednesdays', 0, ['class'=>'form-control', 'placeholder'=>'Wednesdays', 'min' => 0, 'max' => 16]) !!}
            {!! $errors->first('wednesdays', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group {{ $errors->has('thursdays') ? 'has-error' : null }}">
            {!! Form::label('thursdays', 'Thursdays:', ['class'=>'']) !!}
            {!! Form::input('number', 'thursdays', 0, ['class'=>'form-control', 'placeholder'=>'Thursdays', 'min' => 0, 'max' => 16]) !!}
            {!! $errors->first('thursdays', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group {{ $errors->has('fridays') ? 'has-error' : null }}">
            {!! Form::label('fridays', 'Fridays:', ['class'=>'']) !!}
            {!! Form::input('number', 'fridays', 0, ['class'=>'form-control', 'placeholder'=>'Fridays', 'min' => 0, 'max' => 16]) !!}
            {!! $errors->first('fridays', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group {{ $errors->has('saturdays') ? 'has-error' : null }}">
            {!! Form::label('saturdays', 'Saturdays:', ['class'=>'']) !!}
            {!! Form::input('number', 'saturdays', 0, ['class'=>'form-control', 'placeholder'=>'Saturdays', 'min' => 0, 'max' => 16]) !!}
            {!! $errors->first('saturdays', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
</div>

<div class="row">
   <div class="col-sm-2">
        <div class="form-group {{ $errors->has('sundays') ? 'has-error' : null }}">
            {!! Form::label('sundays', 'Sundays:', ['class'=>'']) !!}
            {!! Form::input('number', 'sundays', 0, ['class'=>'form-control', 'placeholder'=>'Sundays', 'min' => 0, 'max' => 16]) !!}
            {!! $errors->first('sundays', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
</div>




