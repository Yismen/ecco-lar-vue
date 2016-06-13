@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		{{-- {{ dd($employee) }} --}}
		<div class="well row">
			{!! Form::model($system, ['route'=>['admin.systems.update', $system->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}		
				<div class="form-group">
					<legend>Edit System {{ $system->display_name }}</legend>
				</div>
			
				@include('systems._form')

				<div class="col-sm-6 col-sm-offset-2">
					<button type="submit" class="btn btn-primary">Update</button>
					<a href="{{ route('admin.systems.index') }}" class="btn btn-default">Cancel</a>
				</div>
			
			{!! Form::close() !!}
			{{-- {!! delete_button('systems.destroy', $system->id, ['class'=>'btn btn-danger','label'=>'Delete <i class="fa fa-trash"></i>']) !!}  --}}
		</div>
	</div>
@stop

@section('scripts')
	
@stop