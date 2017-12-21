<div class="box box-primary">
    <div class="box-body">
        <form action="{{ url('/admin/escalations_admin/by_date') }}" method="POST" class="" role="form" autocomplete="off">
            {!! csrf_field() !!}        
            <legend>Search by Date</legend>
        
            <!-- Production Date -->
            <div class="form-group {{ $errors->has('date') ? 'has-error' : null }}">
                {!! Form::label('date', 'Production Date:', ['class'=>'']) !!}
                {!! Form::input('date', 'date', null, ['class'=>'form-control', 'placeholder'=>'Production Date']) !!}  
                {!! $errors->first('date', '<span class="text-danger">:message</span>') !!}
            </div>

            <div class="form-group">
                <div class="col-sm-6">
                    <div class="checkbox">
                        <label for="detailed">
                            <input type="checkbox" value="1" name="detailed" id="detailed"> 
                            Detailed: 
                        </label>
                    </div>
                </div>

                <div class="col-sm-6">
                    <button class="btn btn-primary" type="submit">
                        <i class="fa fa-search"></i>
                         Search
                    </button> 
                </div>                                 
            </div>
        </form>
    </div>
</div>