<div class="row">
    <div class="col-sm-6">
        <!-- Employee -->
        <div class="form-group {{ $errors->has('employee_id') ? 'has-error' : null }}">
            {!! Form::label('employee_id', ' Employee:', ['class'=>'']) !!}
                {!! Form::select('employee_id', $performance->employeesList->pluck('full_name', 'id'), null, ['class'=>'form-control', 'placeholder'=>'--Select One']) !!}
                {!! $errors->first('employee_id', '<span class="text-danger">:message</span>') !!}
        </div>
        <!-- /. Employee -->
    </div>

    <div class="col-sm-6">
        <!-- Supervisor -->
        <div class="form-group {{ $errors->has('supervisor_id') ? 'has-error' : null }}">
            {!! Form::label('supervisor_id', ' Supervisor:', ['class'=>'']) !!}

            {!! Form::select('supervisor_id', $performance->supervisorsList->pluck('name', 'id'), null, ['class'=>'form-control', 'placeholder'=>'--Select One']) !!}
            {!! $errors->first('supervisor_id', '<span class="text-danger">:message</span>') !!}
        </div>
        <!-- /. Supervisor -->
    </div>
    {{-- /.col         --}}
    
    <div class="col-xs-6">
        <!-- Date -->
        <div class="form-group {{ $errors->has('date') ? 'has-error' : null }}">
            {!! Form::label('date', ' Date:', ['class'=>'']) !!}
            {{-- {!! Form::input('text', 'date', null, ['class'=>'form-control', 'placeholder'=>'Date']) !!} --}}
            <date-picker
                name="date" id="name"
                value="{{ old('date') ?? $performance->date }}"
                format="yyyy-MM-dd"
                :disable-since-many-days-ago="30"
            ></date-picker>
            {!! $errors->first('date', '<span class="text-danger">:message</span>') !!}
        </div>
        {{-- /. Date --}}
    </div>

    <div class="col-xs-6">
        <!-- Login Time -->
        <div class="form-group {{ $errors->has('login_time') ? 'has-error' : null }}">
            {!! Form::label('login_time', ' Login Time:', ['class'=>'']) !!}
            {!! Form::input('number', 'login_time', null, ['step'=>0.05, 'class'=>'form-control', 'placeholder'=>'Login Time']) !!}
            {!! $errors->first('login_time', '<span class="text-danger">:message</span>') !!}
        </div>
        <!-- /. Login Time -->
    </div>

    <div class="col-xs-6">
        <!-- Production Time -->
        <div class="form-group {{ $errors->has('production_time') ? 'has-error' : null }}">
            {!! Form::label('production_time', ' Production Time:', ['class'=>'']) !!}

            {!! Form::input('number', 'production_time', null, ['step'=>0.05, 'class'=>'form-control', 'placeholder'=>'Production Time']) !!}
            {!! $errors->first('production_time', '<span class="text-danger">:message</span>') !!}
        </div>
        <!-- /. Production Time -->
    </div>
    
    <div class="col-xs-6">
        <!-- Sales -->
        <div class="form-group {{ $errors->has('transactions') ? 'has-error' : null }}">
            {!! Form::label('transactions', ' Sales:', ['class'=>'']) !!}

            {!! Form::input('number', 'transactions', null, ['step'=>1, 'class'=>'form-control', 'placeholder'=>'Sales']) !!}
            {!! $errors->first('transactions', '<span class="text-danger">:message</span>') !!}
        </div>
        <!-- /. Sales -->
    </div>
    
    <div class="col-xs-8">
        <div class="form-group {{ $errors->has('campaign_id') ? 'has-error' : null }}">
            {!! Form::label('campaign_id', ' Campaign:', ['class'=>'']) !!}
            {!! Form::select('campaign_id', $performance->campaignsList->pluck('name', 'id'), null, ['class'=>'form-control', 'placeholder' => '--Select One']) !!}
        </div>
    </div>
    <!-- /Campaign -->

    <div class="col-xs-4">
        <!-- Revenue -->
        <div class="form-group {{ $errors->has('revenue') ? 'has-error' : null }}">
            {!! Form::label('revenue', ' Revenue:', ['']) !!}

            {!! Form::input('number', 'revenue', null, ['step'=>0.05, 'class'=>'form-control', 'placeholder'=>'Revenue']) !!}
            {!! $errors->first('revenue', '<span class="text-danger">:message</span>') !!}
        </div>
        <!-- /. Revenue -->
    </div>
