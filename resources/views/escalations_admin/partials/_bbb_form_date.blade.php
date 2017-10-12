<div class="box box-info pad">
    <div class="row">
        <div class="col-sm-12"> 
        {!! Form::open(['url'=>['/admin/escalations_admin/bbbs'], 'method'=>'POST', 'class'=>'', 'role'=>'form', 'autocomplete'=>"off"]) !!}        
                <legend>BBB Records By Date</legend>

                <div class="col-sm-12">
                    <div class="form-group {{ $errors->has('date') ? 'has-error' : null }}">
                        {!! Form::label('date', 'Production Date:', ['class'=>'']) !!}
                            {!! Form::input('date', 'date', null, ['class'=>'form-control', 'placeholder'=>'Production Date']) !!} 
                        {!! $errors->first('date', '<span class="text-danger">:message</span>') !!}
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search"></i>
                             Search BBBs
                        </button>
                    </div>
                </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>