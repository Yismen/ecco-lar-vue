<div class="box box-warning">

    <div class="box-header">
        <h4 class="text-warning">Create Overnight Hours Manually</h4>
        <span class="text-danger text-sm">Only if extremely necessary. Try to avoid this practice</span>
    </div>

    <div class="box-body">
        {!! Form::open(['route'=>['admin.overnight_hours.store'], 'method'=>'POST', 'class'=>'form-horizontal',
        'role'=>'form', 'novalidate'])
        !!}

        <!-- Employee -->
        <div class="col-sm-12">
            <div class="form-group {{ $errors->has('employee_id') ? 'has-error' : null }}">
                {!! Form::label('employee_id', 'Employee:', ['class'=>'col-xs-4 col-md-12']) !!}
                <div class="col-xs-8 col-md-12">
                    {!! Form::select('employee_id', $employees->pluck('full_name', 'id'), null, ['class' =>
                    'form-control input-sm',
                    'placeholder' => '--Selec One']) !!}
                    {!! $errors->first('employee_id', '<span class="text-danger">:message</span>') !!}
                </div>
            </div>
        </div>
        <!-- /. Employee -->

        <!-- Date -->
        <div class="col-xs-6 col-md-12">
            <div class="form-group {{ $errors->has('date') ? 'has-error' : null }}">
                {!! Form::label('date', 'Date:', ['class'=>'col-xs-4 col-md-12']) !!}
                <div class="col-xs-8 col-md-12">
                    <date-picker input-class="form-control input-sm" name="date" format="yyyy-MM-dd"
                        value="{{ old('date') }}"></date-picker>
                    {!! $errors->first('date', '<span class="text-danger">:message</span>') !!}
                </div>
            </div>
        </div>
        <!-- /. Date -->

        <!-- Hours -->
        <div class="col-xs-6 col-md-12">
            <div class="form-group {{ $errors->has('hours') ? 'has-error' : null }}">
                {!! Form::label('hours', 'Hours:', ['class'=>'col-xs-4 col-md-12 input-sm']) !!}
                <div class="col-xs-8 col-md-12">
                    {!! Form::number('hours', null, ['class'=>'form-control', 'placeholder'=>'Hours', 'step' => .05])
                    !!}
                    {!! $errors->first('hours', '<span class="text-danger">:message</span>') !!}
                </div>
            </div>
        </div>
        <!-- /. Hours -->

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <button type="submit" class="btn btn-warning">CREATE</button>
            </div>
        </div>

        {!! Form::close() !!}
    </div>



</div>