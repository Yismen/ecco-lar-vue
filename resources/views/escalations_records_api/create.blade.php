@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Escalations Records', 'page_description'=>'Add a new Escalations Record!'])

@section('content')
	<div class="container">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">
					
					{!! Form::open(['route'=>['admin.escalations_records.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}		
						<legend>Create a New Escalations Record</legend>
					
						@include('escalations_records._form')

						<div class="form-group">
							<div class="col-sm-8 col-sm-offset-2">
								<button class="btn btn-primary" type="submit">SAVE</button>
								<button class="btn btn-default" type="reset">Reset Form</button>
							</div>
						</div>

						{{-- <div class="form-group">
							<div class="col-sm-12">
								<a href="/admin/escalations_records">
									<i class="fa fa-arrow-left"> Back to List</i>
								</a>
							</div>
						</div> --}}
					
					{!! Form::close() !!}
					<hr>

					@if (count($escalations_records) > 0)
						<h4>
							<div class="col-sm-4">
								Your Total Today: <span class="badge badge-info">{{ $escalations_records->total() }}</span>
							</div>
						</h4>
						{{-- Comeback here --}}
						<div class="col-sm-8">
							<form action="{{ url('/admin/escalations_records', $escalations_record->tracking) }}" method="POST" class="" style="">

							    <div class="input-group">
							    	<input type="search" class="form-control" id="search" placeholder="Search">
							    	<span class="input-group-btn">
							    		<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
							    	</span>
							    </div>

							</form>
						</div>
						<table class="table table-condensed table-hover table-bordered table-striped">
							<thead>
								<tr>
									<th>Tracking Number:</th>
									<th>Client:</th>
									<th>Action:</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($escalations_records as $record)
									<tr>
										<td>{{ $record->tracking }}</td>
										<td>{{ $record->escal_client->name }}</td>
										<td>
											<a href="/admin/escalations_records/{{ $record->tracking }}/edit"><i class="fa fa-edit"> Edit</i></a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						{!! $escalations_records !!}
					@else
						<div class="alert alert-info">
							<strong>Fresh Start!</strong> No records have been created today. 
						</div>
					@endif
					
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop