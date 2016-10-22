@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Menus', 'page_description'=>'Edit menu item'])

@section('content')
	<div class="container">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">

							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Edit Menu {{ $menu->display_name }}
										<a href="{{ route('admin.menus.index') }}" class="pull-right">
											<i class="fa fa-angle-double-left"></i>
											 Back
										</a>
									</h3>
								</div>
								<div class="panel-body">
									{!! Form::model($menu, ['route'=>['admin.menus.update', $menu->name], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}
									
										@include('menus._form')

										<div class="col-sm-6 col-sm-offset-2">
											<button type="reset" class="btn btn-default">Cancel</button>
											<button type="submit" class="btn btn-primary">Save</button>
										</div>

									{!! Form::close() !!}

									<div class="col-sm-10 col-sm-offset-1">
										<div class="form-group">
											<hr>
											<form action="{{ url('/admin/menus', $menu->name) }}" method="POST" class="" style="display: inline-block;">
											    {!! csrf_field() !!}
											    {!! method_field('DELETE') !!}
											
											    <button type="submit" id="delete-menu" class="btn btn-danger"  name="deleteBtn">
											        <i class="fa fa-btn fa-trash"></i> Delete
											    </button>
											</form>
										</div>
									</div>
								</div>
							</div>
								
							
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop
