@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		{{-- {{ dd($employee) }} --}}
		<div class="well row">
			{!! Form::model($production, ['route'=>['productions.update', $production->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}	
				<div class="form-group form-group-sm">
					<legend>Edit Production for {{ $production->employee->fullName }}</legend>
				</div>

				<div class="alert alert-warning">
				    {{-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> --}}
				    <strong>Attention!</strong> Dangerous Zone, please act carefully!
				</div>
			
				<!-- Insert Date -->
				<div class="form-group form-group-sm {{ $errors->has('insert_date') ? 'has-error' : null }}">
					{!! Form::label('insert_date', 'Insert Date:', ['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::input('date', 'insert_date', null, ['class'=>'form-control', 'placeholder'=>'Insert Date']) !!}
					</div>
				</div>
				<!-- /. Insert Date -->

				<!-- Production Hours -->
				<div class="form-group form-group-sm {{ $errors->has('production_hours') ? 'has-error' : null }}">
					{!! Form::label('production_hours', 'Production Hours:', ['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::input('number', 'production_hours', null, ['class'=>'form-control', 'placeholder'=>'Production Hours']) !!}
					</div>
				</div>
				<!-- /. Production Hours -->

				<!-- Production -->
				<div class="form-group form-group-sm {{ $errors->has('production') ? 'has-error' : null }}">
					{!! Form::label('production', 'Production:', ['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::input('number', 'production', null, ['class'=>'form-control', 'placeholder'=>'Production']) !!}
					</div>
				</div>
				<!-- /. Production -->

				<!-- Client -->
				<div class="form-group form-group-sm {{ $errors->has('client') ? 'has-error' : null }}">
					{!! Form::label('client', 'Client:', ['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::input('text', 'client', null, ['class'=>'form-control', 'placeholder'=>'Client']) !!}
						<span class="help-block">Change this to a select, with the list of clients</span>
					</div>
				</div>
				<!-- /. Client -->

				<!-- Source -->
				<div class="form-group form-group-sm {{ $errors->has('source') ? 'has-error' : null }}">
					{!! Form::label('source', 'Source:', ['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::input('text', 'source', null, ['class'=>'form-control', 'placeholder'=>'Source']) !!}
						<span class="help-block">Change this to a select, with the list of clients</span>
					</div>
				</div>
				<!-- /. Source -->

				<div class="col-sm-6 col-sm-offset-2">
					<button type="submit" class="btn btn-primary">Update</button>	
					<a href="{{ route('productions.index') }}" class="btn btn-default">Cancel</a>				
				</div>
			
			{!! Form::close() !!}
				
			{{-- {!! delete_button('productions.destroy', $production->id, ['class'=>'btn btn-danger ','label'=>'Delete <i class="fa fa-trash"></i>']) !!}  --}}
				
		</div>
	</div>
{{ $production }}
@stop

@section('scripts')
	
@stop