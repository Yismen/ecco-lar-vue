<div class="row">
    <div class="col-sm-6">
        <!-- Employee -->
        <div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
            {!! Form::label('employee_id', ' Employee:', ['class'=>'']) !!}
                {!! Form::select('employee_id', $performance->employeesList->pluck('full_name', 'id'), null, ['class'=>'form-control']) !!}
                {!! $errors->first('employee_id', '<span class="text-danger">:message</span>') !!}
        </div>
        <!-- /. Employee -->
    </div>

    <div class="col-sm-6">
        <!-- Supervisor -->
        <div class="form-group {{ $errors->has('supervisor_id') ? 'has-error' : null }}">
            {!! Form::label('supervisor_id', ' Supervisor:', ['class'=>'']) !!}

            {!! Form::select('supervisor_id', $performance->supervisorsList->pluck('name', 'id'), null, ['class'=>'form-control', 'placeholder'=>'Supervisor']) !!}
            {!! $errors->first('supervisor_id', '<span class="text-danger">:message</span>') !!}
        </div>
        <!-- /. Supervisor -->
    </div>
    {{-- /.col         --}}
</div>

<div class="row">
    <div class="col-sm-6">
        <!-- Login Time -->
        <div class="form-group {{ $errors->has('login_time') ? 'has-error' : null }}">
            {!! Form::label('login_time', ' Login Time:', ['class'=>'']) !!}
            {!! Form::input('number', 'login_time', null, ['step'=>0.05, 'class'=>'form-control', 'placeholder'=>'Login Time']) !!}
            {!! $errors->first('login_time', '<span class="text-danger">:message</span>') !!}
        </div>
        <!-- /. Login Time -->
    </div>

    <div class="col-sm-6">
        <!-- Production Time -->
        <div class="form-group {{ $errors->has('production_time') ? 'has-error' : null }}">
            {!! Form::label('production_time', ' Production Time:', ['class'=>'']) !!}

            {!! Form::input('number', 'production_time', null, ['step'=>0.05, 'class'=>'form-control', 'placeholder'=>'Production Time']) !!}
            {!! $errors->first('production_time', '<span class="text-danger">:message</span>') !!}
        </div>
        <!-- /. Production Time -->
    </div>

</div>
<div class="row">

    <div class="col-sm-6">
        <!-- Sales -->
        <div class="form-group {{ $errors->has('transactions') ? 'has-error' : null }}">
            {!! Form::label('transactions', ' Sales:', ['class'=>'']) !!}

            {!! Form::input('number', 'transactions', null, ['step'=>1, 'class'=>'form-control', 'placeholder'=>'Sales']) !!}
            {!! $errors->first('transactions', '<span class="text-danger">:message</span>') !!}
        </div>
        <!-- /. Sales -->
    </div>

    <div class="col-sm-6">
        <!-- Revenue -->
        <div class="form-group {{ $errors->has('revenue') ? 'has-error' : null }}">
            {!! Form::label('revenue', ' Revenue:', ['']) !!}

            {!! Form::input('number', 'revenue', null, ['step'=>0.05, 'class'=>'form-control', 'placeholder'=>'Revenue']) !!}
            {!! $errors->first('revenue', '<span class="text-danger">:message</span>') !!}
        </div>
        <!-- /. Revenue -->
    </div>
</div>

<div class="row">
    <!-- Downtime Reason -->
    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('downtime_reason_id') ? 'has-error' : null }}">
            {!! Form::label('downtime_reason_id', ' Downtime Reason:', ['class'=>'']) !!}
            {!! Form::select('downtime_reason_id', $performance->downtimesReasonsList->pluck('name', 'id')->toArray(), null, ['class'=>'form-control']) !!}
            {!! $errors->first('downtime_reason_id', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
    <!-- /. Downtime Reason -->
    <!-- Reported By -->
    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('reported_by') ? 'has-error' : null }}">
            {!! Form::label('reported_by', ' Reported By:', ['class'=>'']) !!}

            {!! Form::select('reported_by', $performance->activeSupervisorsList->pluck('name', 'name')->toArray(), null, ['class'=>'form-control']) !!}
            {!! $errors->first('reported_by', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
</div>
{{-- .row --}}
