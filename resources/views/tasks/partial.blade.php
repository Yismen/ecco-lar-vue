	<div class="container-fluid">
		<div class="row">
		<br>
			<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
				<div class="well">
					<div class="row">
						{!! Form::open(['route'=>['tasks.store'], 'class'=>'', 'role'=>'form']) !!}		
						<div class="form-group">
							<legend>Add your new tasks</legend>
						</div>
					
						@include('tasks._form')
						<hr>
						{!! HTML::linkRoute("tasks.index", "Return to Tasks") !!}
					
					{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>