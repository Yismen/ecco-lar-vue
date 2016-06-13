@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		{{-- {{ dd($employee) }} --}}
		<div class="well row">
			{!! Form::model($menu, ['route'=>['admin.menus.update', $menu->name], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}
				<div class="form-group">
					<legend>Edit Menu {{ $menu->display_name }}</legend>
				</div>
				
				@include('menus._form')

				<div class="col-sm-6 col-sm-offset-2">
					<button type="submit" class="btn btn-primary">Save</button>
				
					<a href="{{ route('admin.menus.index') }}" class="btn btn-default">Cancel</a>
				</div>

			{!! Form::close() !!}
			
			{{-- {!! delete_button('menus.destroy', $menu->name, ['class'=>"btn btn-danger", 'label' => 'Delete']) !!} --}}
		</div>
	</div>
@stop

@section('scripts')

@stop
