@push('scripts')

@stop

@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Overnight Hours', 'page_description'=>'Edit Overnight Hours ID.'])

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box box-warning">
				<div class="box-header">
					<h4>
						Edit Overnight Hours {{ $overnightHour->employee->full_name }}, Date:
						{{ $overnightHour->date->format('d-M-Y') }}

						<a href="{{ route('admin.overnight_hours.index') }}" class="pull-right" title="Back to List">
							<i class="fa fa-home"></i>
						</a>
					</h4>

				</div>


				<div class="box-body">
					{!! Form::model($overnightHour, ['route'=>['admin.overnight_hours.update', $overnightHour->id],
					'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form', 'novalidate' => 'novalidate']) !!}

					<div class="form-group">
						<label for="hours" class="col-xs-3 control-label">Overnight Hours:</label>
						<div class="col-xs-9">
							{!! Form::number('hours', null, ['class' => 'form-control', 'step' => .05]) !!}
							{!! $errors->first('hours', '<span class="text-danger">:message</span>') !!}
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-6 col-sm-offset-2">
							<button type="submit" class="btn btn-warning">UPDATE</button>
						</div>
					</div>


					{!! Form::close() !!}
				</div>

				<div class="box-footer">
					<delete-request-button url="{{ route('admin.overnight_hours.destroy', $overnightHour->id) }}"
						redirect-url="{{ route('admin.overnight_hours.index') }}"></delete-request-button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')

@endpush