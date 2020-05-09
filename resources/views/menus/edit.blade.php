@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Menus', 'page_description'=>'Edit menu item'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h4 class="">Edit Menu {{ $menu->display_name }}
							<a href="{{ route('admin.menus.index') }}" class="pull-right">
								<i class="fa fa-home"></i>
                            	Return to List
							</a>
						</h4>
					</div>
					{{-- /.Box header --}}
					<div class="box-body">
						{!! Form::model($menu, ['route'=>['admin.menus.update', $menu->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}

							@include('menus._form')

							<div class="col-sm-6 col-sm-offset-2">
								<button type="reset" class="btn btn-default">Cancel</button>
								<button type="submit" class="btn btn-primary">Save</button>
							</div>

						{!! Form::close() !!}
					</div>
					{{-- .box body --}}

					<div class="box-footer">
						<div class="col-sm-10 col-sm-offset-1">
							<div class="form-group">
								<delete-request-button
								    url="{{ route('admin.menus.destroy', $menu->id) }}"
								    redirect-url="{{ route('admin.menus.index') }}"
								></delete-request-button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')

@endpush
