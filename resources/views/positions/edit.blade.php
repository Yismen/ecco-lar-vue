@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Positions', 'page_description'=>'Edit position '.$position->name])

@section('content')
	<div class="container-fluid">
		<div class="col-sm-10 col-sm-offset-1">
			<div class="box box-warning">
				<div class="box-header with-border">
					<h4>
						Edit Position {{ $position->name }} 
						<a href="{{ route('admin.positions.index') }}" class="pull-right" title="Back to the list"><i class="fa fa-list"></i></a>
					</h4>
				</div>

				<div class="box-body">
					{!! Form::model($position, ['route'=>['admin.positions.update', $position->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}
						
						@include('positions._form')

						<div class="box-footer with-border">
							<div class="form-group">
								<button type="submit" class="btn btn-warning">UPDATE</button>
							</div>
						</div>
						{{-- / div.box-body --}}
					{!! Form::close() !!}
				</div>
				{{-- / div.box-body --}}
				<hr>
				<div class="box-body">
					
					{!! Form::open(['route'=>['admin.positions.destroy', $position->id], 'method'=>'DELETE']) !!}
						<div class="form-group">
							<button type="submit" class="btn btn-danger" name="deleteBtn"><i class="fa fa-trash"></i> DELETE</button>
						</div>					
					{!! Form::close() !!}
					
				</div>
			</div>
			{{-- / div."box box-primary pad" --}}
		</div>
		{{-- / div.col-sm-10 col-sm-offset-1 --}}
	</div>
@stop

@section('scripts')

@stop
