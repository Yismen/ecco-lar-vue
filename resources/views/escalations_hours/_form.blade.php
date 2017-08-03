<!-- Date -->
<div class="col-sm-12">
    <div class="form-group {{ $errors->has('date') ? 'has-error' : null }}">
        {!! Form::label('date', 'Date:', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            <div class="input-group">
                {!! Form::input('date', 'date', null, ['class'=>'form-control', 'placeholder'=>'Date']) !!}                 
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>       
            {!! $errors->first('date', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
</div>
<!-- /. Date -->

                    