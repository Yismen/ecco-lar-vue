@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Positions', 'page_description'=>$position->name.'\'s details'])

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">
							{{ $position->name }}
						</h3>
							<a href="{{ route('admin.positions.index') }}" class="pull-right">
								<i class="fa fa-home"></i> List
							</a>
					</div>
					{{-- ./ Box header --}}
					<div class="box-body">
						<div class="dl-horizontal">
							<dt>Name:</dt>
							<dd>{{ $position->name }}</dd>
							<dt>Department:</dt>
							<dd>{{ $position->department->department }}</dd>
							<dt>Payment Type:</dt>
							<dd>{{ $position->payment_type ? $position->payment_type->name : 'Please Add One!' }}</dd>
							<dt>Payment Frequency:</dt>
							<dd>{{ $position->payment_frequency ? $position->payment_frequency->name : 'Please Add One!' }}</dd>
							<dt>Salary:</dt>
							<dd>RD$ {{ number_format($position->salary, 2) }}</dd>
						</div>
					</div>
					{{-- .box-body --}}
					<div class="box-footer">
						<a href="{{ route('admin.positions.edit', $position->id) }}" class="btn btn-warning">
							<i class="fa fa-edit"></i> Edit
						</a>
					</div>
				</div>
				{{-- .box --}}
			</div>
			{{-- .column --}}
		</div>
		{{-- /. Row --}}
	</div>
	{{-- .container --}}
@stop

@section('scripts')

@stop