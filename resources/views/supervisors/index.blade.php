@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Supervisors', 'page_description'=>'Supervisors list!'])

@section('content')
	<div class="container-fluid">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box box-primary pad">
                <div class="box-header with-border">
                    Supervisors List
                    <a href="/admin/supervisors/create" class="pull-right"><i class="fa fa-plus"></i> Create</a>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th class="col-sm-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($supervisors as $supervisor)
                                    <tr>
                                        <td><a href="/admin/supervisors/{{ $supervisor->id }}">{{ $supervisor->name }}</a></td>
                                        <td><a href="/admin/departments/{{ $supervisor->department->id }}" target="_new">{{ $supervisor->department->name }}</a></td>
                                        <td>
                                            <a href="/admin/supervisors/{{ $supervisor->id }}/edit">
                                                <i class="fa fa-edit"></i>
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $supervisors }}
                    </div>
                </div>

			</div>
		</div>
	</div>
@stop

@section('scripts')
@stop