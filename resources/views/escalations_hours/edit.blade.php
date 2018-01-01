@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Edit Hours'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h2>
							Edit Hours
							<a href="{{ route('admin.escalations_hours.index') }}" class="pull-right" title="Home"><i class="fa fa-list"></i></a>
						</h2>
					</div>

					<div class="box-body">

						<div class="col-sm-12 well">
							<table class="table table-condensed table-bordered table-striped">
								<tbody>
									<tr>
										<th>Records:</th>
										<th>Production Hours:</th>
										<th>Productivity:</th>
									</tr>
									<tr class="{{
                                        $hours->production_hours <= 0 ? 'danger' : '' 
                                        }}">
										<td>{{ $hours->records }}</td>
										<td>{{ number_format($hours->production_hours, 2) }}</td>
										<td>{{ $hours->production_hours == 0 ? 0 : number_format($hours->records / $hours->production_hours, 2) }}</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="col-sm-12">
							    
							<div class="box-body">
							    {!! Form::model($hours, [
							    	'route'=>['admin.escalations_hours.update', $hours->id], 'method'=>'PUT', 'class'=>'form-horizontal', 
							    	'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"
							    ]) !!}

									
                    
		                            @include('escalations_hours._form')
							
							        <div class="box-footer">
							            <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i> UPDATE</button>
							            <button type="submit" class="btn btn-default">CANCEL</button>
							        </div>
							
							    {!! Form::close() !!}
							</div>  
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop