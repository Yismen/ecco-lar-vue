@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Productions', 'page_description'=>'Edit especific production data.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary pad">
                    <div class="row">
                        <div class="col-sm-12">
                        {{-- {{ $production }}  --}}
                            {!! Form::model($production, ['route'=>['admin.production-hours.update', $production->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form', 'novalidate']) !!}	
									<h4 class="page-header">Edit Production for {{ $production->employee->fullName }}</h4>
{{-- 
									<div class="alert alert-warning">
									    <strong>Attention!</strong> Dangerous Zone, please act carefully!
									</div>
								 --}}
									@include('production-hours._edit-form')

								<div class="col-sm-10 col-sm-offset-2">
								    <div class="col-sm-6">
								    	<div class="form-group">
                                            <button type="submit" class="btn btn-primary form-control">Update</button>
                                        </div>
								    {{-- </div>  
									<div class="col-sm-4"> --}}
										<div class="form-group">
                                            <button type="reset" class="btn btn-warning">Reset</button>                                
                                            <a href="{{ route('admin.productions.show', $production->insert_date) }}" class="btn btn-default">
                                                <i class="fa fa-list"></i>
                                                 Return to Table
                                            </a>
                                        </div> 
									</div>  
									               
								</div>

								
								{!! Form::close() !!}
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop

{{--  --}}