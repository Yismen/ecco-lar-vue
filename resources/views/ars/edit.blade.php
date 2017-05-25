@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Ars', 'page_description'=>'Create a new ars.'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		<div class="box box-primary pad">

			{!! Form::model($ars, ['route'=>['admin.ars.update', $ars->slug], 'method'=>'PATCH', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}
	            <div class="box-body">

	                @include('ars._form')
	                
	            </div>  
	            
	            <div class="box-footer">
	                <button type="reset" class="btn btn-default">CANCEL</button>
	                <button type="submit" class="btn btn-success">UPDATE</button>
	            </div>
	        {!! Form::close() !!}
	        <hr>	

            <a href="{{ route('admin.ars.index') }}"><i class="fa fa-angle-double-left"></i> Back to list</a>
			
			<hr>
			
	        <form action="{{ url('/admin/ars', $ars->slug) }}" method="POST" class="" style="display: inline-block;">
	            {!! csrf_field() !!}
	            {!! method_field('DELETE') !!}
	        
	            <button type="submit" id="delete-ars" class="btn btn-danger"  name="deleteBtn">
	                <i class="fa fa-btn fa-trash"></i> Delete
	            </button>
	        </form>

		</div>
	</div>
@stop

@section('scripts')
	
@stop