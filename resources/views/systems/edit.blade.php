@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Systems', 'page_description'=>'Edit a current system.'])

@section('content')
	<div class="container">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">
					
					{!! Form::model($system, ['route'=>['admin.systems.update', $system->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}		
						<legend>Edit System {{ $system->display_name }}</legend>
					
						@include('systems._form')

						<div class="form-group">
							<div class="col-sm-6 col-sm-offset-2">
								<button type="submit" class="btn btn-primary">Update</button>
								<a href="{{ route('admin.systems.index') }}" class="btn btn-default">Cancel</a>
							</div>
						</div>
					
					{!! Form::close() !!}

					<form action="{{ url('/admin/systems', $system->id) }}" method="POST" class="" style="display: inline-block;">
					    {!! csrf_field() !!}
					    {!! method_field('DELETE') !!}
					
					    <button type="submit" id="delete-system" class="btn btn-danger"  name="deleteBtn">
					        <i class="fa fa-btn fa-trash"></i> Delete
					    </button>
					</form>
					
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop