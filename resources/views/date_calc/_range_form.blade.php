
    {!! Form::open(['route'=>['date_calc.range_diff'], 'method'=>'GET', 'class'=>'', 'role'=>'form', 'autocomplete'=>"off"]) !!} 

        <div class="form-group col-xs-6 {{ $errors->has('from_date') ? 'has-error' : null }}">
            {!! Form::label('from_date', 'From Date:', ['class'=>'']) !!}
            {!! Form::input('date', 'from_date', null, ['class'=>'form-control', 'placeholder'=>'From Date']) !!}                          
        </div>
        <!-- /. From Date -->
        <div class="form-group col-xs-6 {{ $errors->has('to_date') ? 'has-error' : null }}">
            {!! Form::label('to_date', 'From Date:', ['class'=>'']) !!}
            {!! Form::input('date', 'to_date', null, ['class'=>'form-control', 'placeholder'=>'From Date']) !!}                          
        </div>
        <!-- /. From Date -->

        <div class="col-sm-12">
            <div class="form-group">
                <button class="form-control btn btn-primary">Get Range Diff</button>
            </div>
        </div>

    {!! Form::close() !!}