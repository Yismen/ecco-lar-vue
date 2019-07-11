<!-- Employee -->
<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
    {!! Form::label('employee_id', ' Employee:', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('employee_id', $performance->employeesList->pluck('full_name', 'id'), null, ['class'=>'form-control']) !!}
        {!! $errors->first('employee_id', '<span class="text-danger">:message</span>') !!}
    </div>
</div>
<!-- /. Employee -->

<!-- Supervisor -->
<div class="form-group {{ $errors->has('supervisor_id') ? 'has-error' : null }}">
    {!! Form::label('supervisor_id', ' Supervisor:', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('supervisor_id', $performance->supervisorsList->pluck('name', 'id'), null, ['class'=>'form-control', 'placeholder'=>'Supervisor']) !!}
        {!! $errors->first('supervisor_id', '<span class="text-danger">:message</span>') !!}
    </div>
</div>
<!-- /. Supervisor -->

<div class="row">
    <div class="col-sm-6">
        <!-- Login Time -->
        <div class="form-group {{ $errors->has('login_time') ? 'has-error' : null }}">
            {!! Form::label('login_time', ' Login Time:', ['class'=>'col-sm-4 control-label']) !!}
            <div class="col-sm-8">
                {!! Form::input('number', 'login_time', null, ['step'=>0.05, 'class'=>'form-control', 'placeholder'=>'Login Time']) !!}
                {!! $errors->first('login_time', '<span class="text-danger">:message</span>') !!}
            </div>
        </div>
        <!-- /. Login Time -->
    </div>

    <div class="col-sm-6">
        <!-- Production Time -->
        <div class="form-group {{ $errors->has('production_time') ? 'has-error' : null }}">
            {!! Form::label('production_time', ' Production Time:', ['class'=>'col-sm-4 control-label']) !!}
            <div class="col-sm-8">
                {!! Form::input('number', 'production_time', null, ['step'=>0.05, 'class'=>'form-control', 'placeholder'=>'Production Time']) !!}
                {!! $errors->first('production_time', '<span class="text-danger">:message</span>') !!}
            </div>
        </div>
        <!-- /. Production Time -->
    </div>

</div>
<div class="row">

    <div class="col-sm-6">
        <!-- Sales -->
        <div class="form-group {{ $errors->has('transactions') ? 'has-error' : null }}">
            {!! Form::label('transactions', ' Sales:', ['class'=>'col-sm-4 control-label']) !!}
            <div class="col-sm-8">
                {!! Form::input('number', 'transactions', null, ['step'=>1, 'class'=>'form-control', 'placeholder'=>'Sales']) !!}
                {!! $errors->first('transactions', '<span class="text-danger">:message</span>') !!}
            </div>
        </div>
        <!-- /. Sales -->
    </div>

    <div class="col-sm-6">
        <!-- Revenue -->
        <div class="form-group {{ $errors->has('revenue') ? 'has-error' : null }}">
            {!! Form::label('revenue', ' Revenue:', ['class'=>'col-sm-4 control-label']) !!}
            <div class="col-sm-8">
                {!! Form::input('number', 'revenue', null, ['step'=>0.05, 'class'=>'form-control', 'placeholder'=>'Revenue']) !!}
                {!! $errors->first('revenue', '<span class="text-danger">:message</span>') !!}
            </div>
        </div>
        <!-- /. Revenue -->
    </div>
</div>


