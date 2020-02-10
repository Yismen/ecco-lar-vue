@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'Edit Attendance '.$attendance->name])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		<div class="box box-primary">
            <div class="box-header">
                <h4>
                    Edit Attendance: 
                    <a href="{{ route('admin.attendances.index') }}" title="Back to list!" class="pull-right">
                        <i class="fa fa-list"></i> List
                    </a>
                </h4>
            </div>

            {!! Form::model($attendance, ['route'=>['admin.attendances.update', $attendance->id], 'method'=>'PUT', 'class'=>'', 'role'=>'form']) !!}	
                <div class="box-body">
                    <div class="col-xs-6">
                        @component('components.fields.select', [
                            'field_name' => 'employee_id',
                            'list_array' => $attendance->employeesList->pluck('full_name', 'id'),
                        ])
                            Employee Name:
                        @endcomponent       
                    </div>
					@include('attendances._form')	
                </div>

                <div class="box-footer">
                    <div class="col-sm-6 col-sm-offset-2">
						<button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i> UPDATE</button>				
					</div>
                </div>
            {!! Form::close() !!}	

            <div class="box-footer">
                @component('components.delete-button', [
                    'url' => route('admin.attendances.destroy', $attendance->id),
                    'redirect' => route('admin.attendances.index')
                ])                    
                @endcomponent    
            </div>			
		</div>
	</div>

@stop

@section('scripts')
	
@stop