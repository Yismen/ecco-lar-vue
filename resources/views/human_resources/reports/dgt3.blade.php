@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'DGT-3', 'page_description'=>'Select a year to run the DGT3 report.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">

                    <div class="box-header with-border"><h4>Run DGT-3 Report</h4></div>
                        
                    <div class="box-body">
                        {!! Form::open(['/admin/human_resources/dgt3', 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}       
                    
                            <!-- Select a Year -->
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('year') ? 'has-error' : null }}">
                                    {!! Form::label('year', 'Select a Year:', ['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::select('year', $years, null, ['class'=>'form-control input-sm']) !!}
                                        {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <!-- /. Select a Year -->    
                    
                            <!-- Select a Month -->
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('month') ? 'has-error' : null }}">
                                    {!! Form::label('month', 'Select a Month:', ['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::select('month', $months, null, ['class'=>'form-control input-sm']) !!}
                                        {!! $errors->first('month', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <!-- /. Select a Month -->
                    
                            <div class="box-footer">
                                <button type="submit" class="btn btn-default">CANCEL</button>
                                <button type="submit" class="btn btn-primary">SUBMIT</button>
                            </div>
                    
                        {!! Form::close() !!}
                    </div>  
                    
                </div>
            </div>

           
        </div>
         @if (isset($results) && $results->count() == 0)
                <div class="row">
                    <div class="alert alert-error">
                        <strong>Sorry!</strong> Nothing found
                    </div>
                </div>
            @endif
            
            @if (isset($results) && $results->count() > 0)
                @include('human_resources.reports.dgt3_results', ['results' => $results])
            @endif
    </div>
@endsection
@section('scripts')

@stop