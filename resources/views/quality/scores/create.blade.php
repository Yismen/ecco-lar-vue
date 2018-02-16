<div class="box-header with-border">
	<h4> 
		Add a new Quality Score  
	</h4>
</div>

{!! Form::open(['route'=>['admin.quality_scores.store'], 'method'=>'POST', 'class'=>'', 'role'=>'form']) !!}
	<div class="box-body">					
		@include('quality.scores._form')					
	</div>
	<div class="box-footer">
		<button type="submit" class="btn btn-primary">
			<i class="fa fa-floppy-o"></i> CREATE
		</button>
	</div>
{!! Form::close() !!}
	