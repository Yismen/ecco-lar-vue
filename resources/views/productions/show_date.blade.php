@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Productions', 'page_description'=>'Daily Production Data'])

@section('content')
	<div class="container">
    	<div class="row">
			<div class="col-sm-12">
				<div class="box box-primary pad">
    				<div class="table-responsive">
                        <table class="table table-striped table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Employee ID</th>
                                    <th>Name</th>
                                    <th>Source</th>
                                    <th>Client</th>
                                    <th>Prod. Hours</th>
                                    <th>Downtime</th>
                                    <th>Total Hours</th>
                                    <th>Production</th>
                                    <th>TP</th>
                                    <th>
                                        <a href="{{ route('admin.productions.create') }}"><i class="fa fa-plus"></i></a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productions as $p)
                                    <tr>
                                        <td>{{ $p->insert_date }}</td>
                                        <td>{{ $p->employee_id }}</td>
                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->source->name }}</td>
                                        <td>{{ $p->client->name }}</td>
                                        <td>{{ $p->production_hours }}</td>
                                        <td>{{ $p->downtime }}</td>
                                        <td>{{ $p->downtime + $p->production_hours}}</td>
                                        <td>{{ $p->production }}</td>
                                        <td>{{ number_format($p->production / $p->production_hours, 2) }}</td>
                                        <td>
                                            <a href="{{ route('admin.productions.edit',$p->id) }}"><i class="fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
@endsection