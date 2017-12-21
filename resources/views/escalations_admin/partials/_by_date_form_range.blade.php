<div class="box box-success">
    <div class="box-body">
        <form action="{{ url('/admin/escalations_admin/by_range') }}" method="POST" class="" role="form" autocomplete="off">
            {!! csrf_field() !!}        
            <legend>Search by Range Date</legend>
        
            <div class="row">
                <div class="col-sm-6">
                    <!-- Production Date -->
                    <div class="form-group {{ $errors->has('from') ? 'has-error' : null }}">
                        {!! Form::label('from', 'Production Date:', ['class'=>'']) !!}
                        {!! Form::input('date', 'from', null, ['class'=>'form-control', 'placeholder'=>'Production Date']) !!}  
                        {!! $errors->first('from', '<span class="text-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- Production Date -->
                    <div class="form-group {{ $errors->has('to') ? 'has-error' : null }}">
                        {!! Form::label('to', 'Production Date:', ['class'=>'']) !!}
                        {!! Form::input('date', 'to', null, ['class'=>'form-control', 'placeholder'=>'Production Date']) !!}  
                        {!! $errors->first('to', '<span class="text-danger">:message</span>') !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-6">
                    <button class="btn btn-success form-control" type="submit">
                        <i class="fa fa-search"></i>
                         Search Range
                    </button> 
                </div>                                 
            </div>
        </form>
    </div>
</div>