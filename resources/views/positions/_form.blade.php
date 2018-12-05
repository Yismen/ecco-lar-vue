<div class="row">
	<div class="col-sm-12">
		<!-- Position Name -->
		<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
			{!! Form::label('name', 'Position Name:', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-10">
				{!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Position Name']) !!}
				{!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
			</div>
		</div>
		<!-- /. Position Name -->
	</div>

	<div class="col-sm-6">
		<!-- Department -->
		<div class="form-group {{ $errors->has('department_id') ? 'has-error' : null }}">
			{!! Form::label('department_id', 'Department:', ['class'=>'col-sm-3 control-label']) !!}
			<div class="col-sm-9">
				<div class="input-group">
					{{-- {{ dd($position->departments_list) }} --}}
					{!! Form::select('department_id', $position->departments_list->pluck('department', 'id'), null, ['class'=>'form-control', 'id'=>'department_id']) !!}
					<div class="input-group-btn">
						<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#myModal">
							<i class="fa fa-plus"></i>
						</button>
					</div>
				</div>
				{!! $errors->first('department_id', '<span class="text-danger">:message</span>') !!}
			</div>

		</div>
		<!-- /. Department -->

	</div>
	<div class="col-sm-6">
		<!-- Payment Type -->
		<div class="form-group {{ $errors->has('payment_type_id') ? 'has-error' : null }}">
			{!! Form::label('payment_type_id', 'Payment Type:', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-10">
				{!! Form::select('payment_type_id', $position->paymentTypesList->pluck('name', 'id'), null, ['class'=>'form-control', 'id'=>'payment_type_id']) !!}
				{!! $errors->first('payment_type_id', '<span class="text-danger">:message</span>') !!}
			</div>
		</div>
		<!-- /. Payment Type -->
	</div>
	{{-- /. col-sm-6 --}}
	<div class="col-sm-6">
		<!-- Payment Frequency -->
		<div class="form-group {{ $errors->has('payment_frequency_id') ? 'has-error' : null }}">
			{!! Form::label('payment_frequency_id', 'Payment Frequency:', ['class'=>'col-sm-3 control-label']) !!}
			<div class="col-sm-9">
				{!! Form::select('payment_frequency_id', $position->paymentFrequenciesList->pluck('name', 'id'), null, ['class'=>'form-control', 'id'=>'payment_frequency_id']) !!}
				{!! $errors->first('payment_frequency_id', '<span class="text-danger">:message</span>') !!}
			</div>
		</div>
		<!-- /. Payment Frequency -->
	</div>
		<!-- Salary -->
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('salary') ? 'has-error' : null }}">
			{!! Form::label('salary', 'Salary:', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-10">
				{!! Form::input('number', 'salary', null, ['class'=>'form-control', 'placeholder'=>'Salary', 'min'=>0, 'max'=>550000]) !!}
				{!! $errors->first('salary', '<span class="text-danger">:message</span>') !!}
			</div>
		</div>
		<!-- /. Salary -->
	</div>
</div>


{{-- <div class="modal fade in" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4> -->
      </div>
      <div class="modal-body">
        @include('departments._form')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="createDepartment">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> --}}

