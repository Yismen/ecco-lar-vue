
{!! Form::open(['route'=>['date_calc.diff_from_today'], 'method'=>'GET', 'class'=>'', 'role'=>'form', 'autocomplete'=>"off"]) !!} 

    <div class="form-group {{ $errors->has('base_date') ? 'has-error' : null }}">
        {!! Form::label('base_date', 'From Date:', ['class'=>'']) !!}
        
        <div class="input-group">
            {!! Form::input('date', 'base_date', null, ['class'=>'form-control', 'placeholder'=>'From Date']) !!}

              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">Calculate!</button>
              </span>
        </div>
    </div>
    <!-- /. From Date -->
    {{-- Errors --}}
{!! Form::close() !!}
                            