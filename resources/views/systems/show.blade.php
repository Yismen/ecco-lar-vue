@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Systems', 'page_description'=>'Show system details'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="box box-primary pad">

					<ul class="list-group">
						<li class="list-group-item">
							<strong>Name: </strong>{{ $system->name }}
						</li>
						<li class="list-group-item">
							<strong>Display Name: </strong>{{ $system->display_name }}
						</li>
						<li class="list-group-item">
							<strong>Description: </strong>{{ $system->description }}
						</li>
						
						<li class="list-group-item">
							<strong>URL: </strong> <a href="{{ $system->url }}" target="_new">{{ $system->url }}</a>
						</li>
					</ul>
					<a href="{{ route('admin.systems.edit', $system->id) }}" class="btn btn-warning"> Edit
						<i class="fa fa-edit"></i>
					</a>
					{{-- {!! delete_button('systems.destroy', $system->id, ['class'=>"btn btn-danger", 'label' => 'Delete']) !!} --}}
					<hr>
					<a href="{{ route('admin.systems.index') }}" class=""> << Return to Systems List</a>
					
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop