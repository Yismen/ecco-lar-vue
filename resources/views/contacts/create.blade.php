@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Contacts', 'page_description'=>'Create a New Contact.'])

@section('content')
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>
						New Contact
						<a href="{{ route('admin.contacts.index') }}" title="Back to List"	class="pull-right"><i class="fa fa-home"></i> Back</a>
					</h4>
				</div>
				{!! Form::open(['route'=>['admin.contacts.store'], 'class'=>'', 'role'=>'form']) !!}

					<div class="box-body">
						@include('contacts._form')

					</div>

					<div class="box-footer">
						<div class="form-group">
							<div class="col-sm-8 col-sm-offset-2">
								<button class="btn btn-primary"><i class="fa fa-floppy-o"></i> SAVE</button>
							</div>
						</div>
					</div>



				{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop

@push('scripts')

@endpush