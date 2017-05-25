@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Cards', 'page_description'=>'Create a new card.'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		<div class="box box-primary pad">

			{!! Form::model($afp, ['route'=>['admin.afps.update', $afp->slug], 'method'=>'PATCH', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}
	            <div class="box-body">

	                @include('afp._form')
	                
	            </div>  
	            
	            <div class="box-footer">
	                <button type="reset" class="btn btn-default">CANCEL</button>
	                <button type="submit" class="btn btn-success">UPDATE</button>
	            </div>
	        {!! Form::close() !!}
			
			<hr>

			<a href="{{ route('admin.afps.index') }}"><i class="fa fa-angle-double-left"></i> Back to list</a>

			<hr>
			
	        <form action="{{ url('/admin/afps', $afp->slug) }}" method="POST" class="" style="display: inline-block;">
	            {!! csrf_field() !!}
	            {!! method_field('DELETE') !!}
	        
	            <button type="submit" id="delete-afp" class="btn btn-danger"  name="deleteBtn">
	                <i class="fa fa-btn fa-trash"></i> Delete
	            </button>
	        </form>

		</div>
	</div>
@stop

@section('scripts')
	
@stop