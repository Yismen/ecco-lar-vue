@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'No Description'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		{{-- {{ dd($employee) }} --}}
		<div class="well row">
			{!! Form::model($menu, ['route'=>['menus.update', $menu->name], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}		
				<div class="form-group">
					<legend>Edit Menu {{ $menu->display_name }}</legend>
				</div>
			
				@include('menus._form')

				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-primary form-control">Save</button>
					<br><br>
					<a href="{{ route('menus.index') }}"><< Return to Menus List</a>
				</div>
			
			{!! Form::close() !!}
		</div>
	</div>
@stop

@push('scripts')
	
@endpush