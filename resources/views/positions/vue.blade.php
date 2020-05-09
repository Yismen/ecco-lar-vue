@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Positions', 'page_description'=>'Positions list!'])

@section('content')
<div class="container-fluid">
	<div class="col-sm-10 col-sm-offset-1">
		<div class="box box-primary">
			<div class="box-header">
				<h3>
					Positions Items List
					<router-link :to="{path: '/'}" class="pull-right">
						<i class="fa fa-home"></i>
					</router-link>
				</h3>
			</div>
			<div class="box-body">
				<router-view name="positions"></router-view>
				<router-view></router-view>
			</div>

		</div>
	</div>
</div>
@stop

@push('scripts')

@endpush