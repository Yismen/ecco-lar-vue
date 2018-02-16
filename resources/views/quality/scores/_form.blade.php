<div class="row">
    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('employee_id') ? 'has-error' : null }}">
            <label for="employee_id" class="">Employee:</label>
            {!! Form::select('employee_id', $score->employees_list, null, ['class'=>'form-control select2','id'=>'employee_id','tabindex'=>1]) !!}
            {!! $errors->first('employee_id', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
    {{-- /.Employee --}}

    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('client_id') ? 'has-error' : null }}">
            <label for="client_id" class="">Client:</label>
            {!! Form::select('client_id', $score->clients_list, null, ['class'=>'form-control select2','id'=>'client_id','tabindex'=>2]) !!}
            {!! $errors->first('client_id', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
    {{-- /.Client --}}
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('work_date') ? 'has-error' : null }}">
            <label for="work_date" class="">Work Date:</label>
            {!! Form::date('work_date', null, ['class'=>'form-control','id'=>'work_date']) !!}
            {!! $errors->first('work_date', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
    {{-- /.Work Date --}}

    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('score') ? 'has-error' : null }}">
            <label for="score" class="">Score:</label>
            {!! Form::number('score', null, ['class'=>'form-control','id'=>'score','step'=>0.01,'min'=>0,'max'=>100]) !!}
            {!! $errors->first('score', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
    {{-- /.Score --}}
</div>