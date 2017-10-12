<div class="box box-primary pad">
    {!! Form::open(['url'=>['/admin/escalations_admin/bbbs_range'], 'method'=>'POST', 'class'=>'', 'role'=>'form', 'autocomplete'=>"off"]) !!}        
        <legend>BBB Records by Range</legend>

         <!-- Production Date -->
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group {{ $errors->has('from') ? 'has-error' : null }}">
                    {!! Form::label('from', 'From Date:', ['class'=>'']) !!}
                    {!! Form::input('date', 'from', null, ['class'=>'form-control', 'placeholder'=>'Production Date']) !!} 
                    {!! $errors->first('from', '<span class="text-danger">:message</span>') !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group {{ $errors->has('to') ? 'has-error' : null }}">
                    {!! Form::label('to', 'To Date:', ['class'=>'']) !!}
                    {!! Form::input('date', 'to', null, ['class'=>'form-control', 'placeholder'=>'Production Date']) !!} 
                    {!! $errors->first('to', '<span class="text-danger">:message</span>') !!}
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">

                    <button class="btn btn-info" type="submit">
                        <i class="fa fa-search"></i>
                         SEARCH RANGE
                    </button>
                </div>
            </div>
        </div>

        

    {!! Form::close() !!}
</div>