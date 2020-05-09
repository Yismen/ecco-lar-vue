@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Universals', 'page_description'=>'Edit Universal ID.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-warning">
					<div class="box-header">
						<h4>
							Edit Universal {{ $universal->employee->full_name }}

							<a href="{{ route('admin.universals.index') }}" class="pull-right" title="Back to List">
								<i class="fa fa-home"></i>
							</a>
						</h4>

					</div>


					<div class="box-body">
						{!! Form::model($universal, ['route'=>['admin.universals.update', $universal->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}

							<div class="form-group">
						        <label for="since" class="col-xs-3 control-label">Universal Since:</label>
						        <div class="col-xs-9">
						            <date-picker input-class="form-control input-sm"
						                name="since"
						                format="yyyy-MM-dd"
						            ></date-picker>
						            {!! $errors->first('since', '<span class="text-danger">:message</span>') !!}
						        </div>
						    </div>

							<div class="form-group">
								<div class="col-sm-6 col-sm-offset-2">
									<button type="submit" class="btn btn-warning">Update</button>
								</div>
							</div>


						{!! Form::close() !!}
					</div>

					<div class="box-footer">
						<delete-request-button
							url="{{ route('admin.universals.destroy', $universal->id) }}"
							redirect-url="{{ route('admin.universals.index') }}"
						></delete-request-button>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')

@endpush
