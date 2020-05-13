@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Attendance Codes', 'page_description'=>'Edit Attendance Codes.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-warning">
					<div class="box-header">
						<h4>
							Edit Attendance Code {{ $attendanceCode->name }}
							<a href="/admin/attendance_codes" class="pull-right" title="Back to the list">
					    		List  
						    	<i class="fa fa-list"></i>
						    </a>
						</h4>						
					</div>
						

					<div class="box-body">
						{!! Form::model($attendanceCode, ['route'=>['admin.attendance_codes.update', $attendanceCode->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}

							@include('attendance_codes._form')

							<div class="form-group">
								<div class="col-sm-6 col-sm-offset-2">
									<button type="submit" class="btn btn-warning">UPDATE</button>	
									
								</div>			
							</div>

							<div class="box-footer">
								<button type="reset" class="btn btn-default">Reset Form</button>
							</div>

						
						{!! Form::close() !!}
					</div>

					{{-- <div class="box-footer">
						<delete-request-button
							url="{{ route('admin.attendance_codes.destroy', $attendanceCode->id) }}"
							redirect-url="{{ route('admin.attendance_codes.index') }}"
						></delete-request-button>
					</div> --}}

				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')

@endpush