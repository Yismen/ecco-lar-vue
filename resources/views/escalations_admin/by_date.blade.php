@extends('escalations_admin.home')

@section('views')
    
    <div class="row">
        <div class="col-sm-12">
            {!! Form::open(['url'=>['/admin/escalations_admin/by_date',], 'method'=>'POST', 'class'=>'form-inline', 'role'=>'form', 'autocomplete'=>"off"]) !!}        
                <legend>Search by Date</legend>
            
                <div class="col-sm-12">
                
                    <!-- Production Date -->
                    <div class="form-group {{ $errors->has('date') ? 'has-error' : null }}">
                        {!! Form::label('date', 'Production Date:', ['class'=>'']) !!}
                        {!! Form::input('date', 'date', null, ['class'=>'form-control', 'placeholder'=>'Production Date']) !!}  
                        {!! $errors->first('date', '<span class="text-danger">:message</span>') !!}
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <b>Detailed</b>
                                <input type="checkbox" value="1" name="detailed">
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search"></i>
                             Search
                        </button>  
                    </div>

                </div>
                <!-- /. Production Date --> 
            {!! Form::close() !!}


            @if (isset($clients) && isset($users) && isset($summary))
                <hr>    

                <div class="col-sm-12">
                    <div class="page-header">Results for Date [{{ Request::old('date') }}] </div>
                </div>
            @endif
                
            @include('escalations_admin.partials._by_date_summary_table')
            @include('escalations_admin.partials._by_date_clients_table')
            @include('escalations_admin.partials._by_date_users_table')
            @include('escalations_admin.partials._by_date_detailed_table')
        </div>
    </div>
@stop