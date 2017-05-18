@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Positions', 'page_description'=>'Edit position '.$position->name])

@section('content')
	<div class="container-fluid">
		<div class="box box-primary pad">
			<div class="row">
				<div class="col-sm-12">
					{!! Form::model($position, ['route'=>['admin.positions.update', $position->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}
						<div class="form-group">
							<legend>Edit Position {{ $position->name }}</legend>
						</div>
						
						@include('positions._form')

						<div class="col-sm-10 col-sm-offset-2">
							<button type="submit" class="btn btn-primary">Save</button>
							{{-- {!! delete_button('positions.destroy', $position->id, ['label'=>'Delete', 'class'=>'btn btn-danger']) !!} --}}
							<hr>
							<a href="{{ route('admin.positions.index') }}"><< Return to Positions List</a>
						</div>

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@stop

@section('scripts')

@stop
