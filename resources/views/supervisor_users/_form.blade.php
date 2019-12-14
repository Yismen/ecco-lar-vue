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
        <div class="form-group {{ $errors->has('monday') ? 'has-error' : null }}">
            {!! Form::label('monday', 'Monday:', ['class'=>'']) !!}
            {!! Form::input('number', 'monday', 0, ['class'=>'form-control', 'placeholder'=>'Monday', 'min' => 0, 'max' => 16]) !!}
            {!! $errors->first('monday', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group {{ $errors->has('tuesday') ? 'has-error' : null }}">
            {!! Form::label('tuesday', 'Tuesday:', ['class'=>'']) !!}
            {!! Form::input('number', 'tuesday', 0, ['class'=>'form-control', 'placeholder'=>'Tuesday', 'min' => 0, 'max' => 16]) !!}
            {!! $errors->first('tuesday', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group {{ $errors->has('wednesday') ? 'has-error' : null }}">
            {!! Form::label('wednesday', 'Wednesday:', ['class'=>'']) !!}
            {!! Form::input('number', 'wednesday', 0, ['class'=>'form-control', 'placeholder'=>'Wednesday', 'min' => 0, 'max' => 16]) !!}
            {!! $errors->first('wednesday', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group {{ $errors->has('thursday') ? 'has-error' : null }}">
            {!! Form::label('thursday', 'Thursday:', ['class'=>'']) !!}
            {!! Form::input('number', 'thursday', 0, ['class'=>'form-control', 'placeholder'=>'Thursday', 'min' => 0, 'max' => 16]) !!}
            {!! $errors->first('thursday', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group {{ $errors->has('friday') ? 'has-error' : null }}">
            {!! Form::label('friday', 'Friday:', ['class'=>'']) !!}
            {!! Form::input('number', 'friday', 0, ['class'=>'form-control', 'placeholder'=>'Friday', 'min' => 0, 'max' => 16]) !!}
            {!! $errors->first('friday', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group {{ $errors->has('saturday') ? 'has-error' : null }}">
            {!! Form::label('saturday', 'Saturday:', ['class'=>'']) !!}
            {!! Form::input('number', 'saturday', 0, ['class'=>'form-control', 'placeholder'=>'Saturday', 'min' => 0, 'max' => 16]) !!}
            {!! $errors->first('saturday', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
</div>

<div class="row">
   <div class="col-sm-2">
        <div class="form-group {{ $errors->has('sunday') ? 'has-error' : null }}">
            {!! Form::label('sunday', 'Sunday:', ['class'=>'']) !!}
            {!! Form::input('number', 'sunday', 0, ['class'=>'form-control', 'placeholder'=>'Sunday', 'min' => 0, 'max' => 16]) !!}
            {!! $errors->first('sunday', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
</div>




