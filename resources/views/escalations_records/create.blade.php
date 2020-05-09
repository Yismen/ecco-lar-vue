@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Escalations Records', 'page_description'=>'Add a new Escalations Record!'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">
					
					{!! Form::open(['route'=>['admin.escalations_records.store'], 'method'=>'POST', 'class'=>'well form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}		
						<legend>Create a New Escalations Record</legend>
					
						@include('escalations_records._form')

						<div class="form-group">
							<div class="col-sm-8 col-sm-offset-2">
								<button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o">	</i> SAVE</button>
								<button class="btn btn-default" type="reset"><i class="fa fa-refresh">	</i> Reset Form</button>
							</div>
						</div>
					
					{!! Form::close() !!}
					<hr>

					@if (count($escalations_records) > 0)
						<div class="box-body">
								<h4>
								<div class="col-sm-4">
									Your Total Today: <span class="label label-success">{{ $escalations_records->total() }}</span>
								</div>
							</h4>
							{{-- Comeback here --}}
							<div class="col-sm-8">
								<form action="{{ url('/admin/escalations_records/search') }}" method="POST" class="" style="">
									{!! csrf_field() !!}

									<div class="input-group">
										<input name="search" type="search" class="form-control" id="search" placeholder="Search">
										<span class="input-group-btn">
											<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
										</span>
									</div>

								</form>
							</div>
						</div>
						<div class="box-body">
							<table class="table table-condensed table-hover table-bordered table-striped">
								<thead>
									<tr>
										<th>Tracking Number:</th>
										<th>Client:</th>
										<th>Additional?:</th>
										<th>BBB?:</th>
										<th>Action:</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($escalations_records as $record)
										<tr class="{{ $record->is_bbb ? 'danger' : '' }}">
											<td>{{ $record->tracking }}</td>
											<td>{{ $record->escal_client->name }}</td>
											<td>{!! $record->is_additional_line ? '<i class="fa fa-check"></i> Yes' : '' !!}</td>
											<td>{!! $record->is_bbb ? '<i class="fa fa-check"></i> Yes' : '' !!}</td>
											<td>
												<a href="/admin/escalations_records/{{ $record->id }}/edit"><i class="fa fa-edit"> Edit</i></a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
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
@push('scripts')

@endpush