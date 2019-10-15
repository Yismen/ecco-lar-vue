<!-- Holiday Name -->
<div class="col-xs-6 col-md-12">
    <div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
        {!! Form::label('name', 'Holiday Name:', ['class'=>'col-xs-12 ']) !!}
        <div class="col-xs-12">
            {!! Form::text('name', null, ['class'=>'form-control input-sm', 'placeholder'=>'Holiday Name'])
            !!}
            {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
</div>
<!-- /. Holiday Name -->

<!-- Date -->
<div class="col-xs-6 col-md-12">
    <div class="form-group {{ $errors->has('date') ? 'has-error' : null }}">
        {!! Form::label('date', 'Date:', ['class'=>'col-xs-12']) !!}
        <div class="col-xs-12">
            <date-picker input-class="form-control input-sm" name="date" format="yyyy-MM-dd"
                :allow-future-dates="true"
                :disable-since-many-days-ago="{{ now()->subMonths(6)->startOfMonth()->diffInDays() }}"
                value="{{ $holiday->date ?? old('date') }}">
            </date-picker>
            {!! $errors->first('date', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
</div>
<!-- /. Date -->

<!-- Description -->
<div class="col-xs-12">
    <div class="form-group {{ $errors->has('description') ? 'has-error' : null }}">
        {!! Form::label('description', 'Description:', ['class'=>'col-xs-12']) !!}
        <div class="col-xs-12">
            {!! Form::textarea('description', null, ['class'=>'form-control', 'placeholder'=>'Description', 'rows' =>
            3]) !!}
            {!! $errors->first('description', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
</div>
<!-- /. Description -->