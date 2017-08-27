@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Edit Hours'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h2>
							Edit Hours
							<a href="{{ route('admin.escalations_hours.index') }}" class="pull-right" title="Home"><i class="fa fa-list"></i></a>
						</h2>
					</div>

					<div class="box-body">

						<div class="col-sm-4">
							<table class="table table-condensed table-bordered">
								<tbody>
									<tr>
										<th>Records:</th>
										<td>{{ $hours->records }}</td>
									</tr>
									<tr>
										<th>Production Hours:</th>
										<td>{{ number_format($hours->production_hours, 3) }}</td>
									</tr>
									<tr>
										<th>Productivity:</th>
										<td>{{ number_format($hours->records / $hours->production_hours, 2) }}</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="col-sm-8">
							    
							<div class="box-body">
							    {!! Form::model($hours, [
							    	'route'=>['admin.escalations_hours.update', $hours->id], 'method'=>'PUT', 'class'=>'form-horizontal', 
							    	'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"
							    ]) !!}

									<!-- User -->
									<div class="col-sm-12">
										<div class="form-group {{ $errors->has('user_id') ? 'has-error' : null }}">
											{!! Form::label('user_id', 'User:', ['class'=>'col-sm-2 control-label']) !!}
											<div class="col-sm-10">
												{!! Form::select('user_id', $hours->users, null, ['class'=>'form-control input-sm']) !!}
										        {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
											</div>
										</div>
									</div>
									<!-- /. User -->

									<!-- Client -->
									<div class="col-sm-12">
										<div class="form-group {{ $errors->has('client_id') ? 'has-error' : null }}">
											{!! Form::label('client_id', 'Client:', ['class'=>'col-sm-2 control-label']) !!}
											<div class="col-sm-10">
												{!! Form::select('client_id', $hours->clients, null, ['class'=>'form-control input-sm']) !!}
										        {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
											</div>
										</div>
									</div>
									<!-- /. Client -->

							    	<!-- Date -->
							    	<div class="col-sm-12">
							    		<div class="form-group {{ $errors->has('date') ? 'has-error' : null }}">
							    			{!! Form::label('date', 'Date:', ['class'=>'col-sm-2 control-label']) !!}
							    			<div class="col-sm-10">
							    				{!! Form::input('text', 'date', null, ['class'=>'form-control', 'placeholder'=>'Date']) !!}        
							    		        {!! $errors->first('date', '<span class="text-danger">:message</span>') !!}
							    			</div>
							    		</div>
							    	</div>
							    	<!-- /. Date -->

							    	<!-- Time In -->
							    	<div class="col-sm-12">
							    		<div class="form-group {{ $errors->has('entrance') ? 'has-error' : null }}">
							    			{!! Form::label('entrance', 'Time In:', ['class'=>'col-sm-2 control-label']) !!}
							    			<div class="col-sm-10">
							    				{!! Form::input('text', 'entrance', null, ['class'=>'form-control', 'placeholder'=>'Time In']) !!}        
							    		        {!! $errors->first('entrance', '<span class="text-danger">:message</span>') !!}
							    			</div>
							    		</div>
							    	</div>
							    	<!-- /. Time In -->

							    	<!-- Time Out -->
							    	<div class="col-sm-12">
							    		<div class="form-group {{ $errors->has('out') ? 'has-error' : null }}">
							    			{!! Form::label('out', 'Time Out:', ['class'=>'col-sm-2 control-label']) !!}
							    			<div class="col-sm-10">
							    				{!! Form::input('text', 'out', null, ['class'=>'form-control', 'placeholder'=>'Time Out']) !!}        
							    		        {!! $errors->first('out', '<span class="text-danger">:message</span>') !!}
							    			</div>
							    		</div>
							    	</div>
							    	<!-- /. Time Out -->

							    	<!-- Break (Minutes) -->
							    	<div class="col-sm-12">
							    		<div class="form-group {{ $errors->has('break') ? 'has-error' : null }}">
							    			{!! Form::label('break', 'Break (Minutes):', ['class'=>'col-sm-2 control-label']) !!}
							    			<div class="col-sm-10">
							    				{!! Form::input('text', 'break', null, ['class'=>'form-control', 'placeholder'=>'Break (Minutes)']) !!}        
							    		        {!! $errors->first('break', '<span class="text-danger">:message</span>') !!}
							    			</div>
							    		</div>
							    	</div>
							    	<!-- /. Break (Minutes) -->
							
							        <div class="box-footer">
							            <button type="submit" class="btn btn-default">CANCEL</button>
							            <button type="submit" class="btn btn-primary">SUBMIT</button>
							        </div>
							
							    {!! Form::close() !!}
							</div>  
						</div>
					</div>

					<div class="box-footer">
						{{ $hours }}
					</div>
					
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop