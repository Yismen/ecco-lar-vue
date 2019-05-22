

<div class="row">
	<div class="col-sm-6">
		<!-- Name -->
		<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
			{!! Form::label('name', ' Name:', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-10">
				{!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Name']) !!}
				{!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
			</div>
		</div>
		<!-- /. Name -->
	</div>
	<div class="col-sm-6">
		<!-- Project -->
		<div class="form-group {{ $errors->has('project_id') ? 'has-error' : null }}">
			{!! Form::label('project_id', ' Project:', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-10">
				{!! Form::select('project_id', $campaign->project_list->pluck('name', 'id'), null, ['class'=>'form-control']) !!}
				{!! $errors->first('project_id', '<span class="text-danger">:message</span>') !!}
			</div>
		</div>
		<!-- /. Project -->
	</div>
</div>

<div class="row">
	<div class="col-sm-6">
		<!-- Source -->
		<div class="form-group {{ $errors->has('source_id') ? 'has-error' : null }}">
			{!! Form::label('source_id', ' Source:', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-10">
				{!! Form::select('source_id', $campaign->source_list->pluck('name', 'id'), null, ['class'=>'form-control']) !!}
				{!! $errors->first('source_id', '<span class="text-danger">:message</span>') !!}
			</div>
		</div>
	</div>
	<div class="col-sm-6"><!-- Revenue Type -->
		<div class="form-group {{ $errors->has('revenue_type_id') ? 'has-error' : null }}">
			{!! Form::label('revenue_type_id', ' Revenue Type:', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-10">
					{!! Form::select('revenue_type_id', $campaign->revenue_type_list->pluck('name', 'id'), null, ['class'=>'form-control']) !!}
				{!! $errors->first('revenue_type_id', '<span class="text-danger">:message</span>') !!}
			</div>
		</div>
		<!-- /. Revenue Type -->
	</div>
</div>

<div class="row">
	<div class="col-sm-6"><!-- Revenue Rate -->
		<div class="form-group {{ $errors->has('revenue_rate') ? 'has-error' : null }}">
			{!! Form::label('revenue_rate', ' Revenue Rate:', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-10">
				{!! Form::input('number', 'revenue_rate', null, ['class'=>'form-control', 'step' => '0.001', 'placeholder'=>'Revenue Rate']) !!}
				{!! $errors->first('revenue_rate', '<span class="text-danger">:message</span>') !!}
			</div>
		</div>
		<!-- /. Revenue Rate -->
	</div>
	<div class="col-sm-6">
		<!-- SPH Goal -->
		<div class="form-group {{ $errors->has('sph_goal') ? 'has-error' : null }}">
			{!! Form::label('sph_goal', ' SPH Goal:', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-10">
				{!! Form::input('number', 'sph_goal', null, ['class'=>'form-control', 'step' => '0.001', 'placeholder'=>'SPH Goal']) !!}
				{!! $errors->first('sph_goal', '<span class="text-danger">:message</span>') !!}
			</div>
		</div>
		<!-- /. SPH Goal -->
	</div>
</div>
