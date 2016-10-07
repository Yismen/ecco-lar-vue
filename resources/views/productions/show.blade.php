@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Productions', 'page_description'=>'Daily Production Data'])

@section('content')
	<div class="container">
    	<div class="row">
			<div class="col-sm-12">
				<div class="box box-primary pad">

                    <h3>
                        Productions Details, Date: {{ $date }}
                        <a href="{{ route('admin.productions.index') }}" class="pull-right" title="Return to List"><i class="fa fa-list"></i></a>
                    </h3>

                    <table class="table table-condensed table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Employee ID:</th>
                                <th>Name:</th>
                                <th>Client:</th>
                                <th>Source:</th>
                                <th>Production Hours:</th>
                                <th>Downtime:</th>
                                <th>Records:</th>
                                <th>TP:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productions as $production)
                                <tr>
                                    <td>{{ $production->employee->id }}</td>
                                    <td>{{ $production->employee->first_name }} {{ $production->employee->last_name }}</td>
                                    <td>{{ $production->client->name }}</td>
                                    <td>{{ $production->source->name }}</td>
                                    <td>{{ $production->production_hours }}</td>
                                    <td>{{ $production->downtime }}</td>
                                    <td>{{ $production->production }}</td>
                                    <td>{{ number_format($production->production / $production->production_hours, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
				</div>
			</div>
		</div>
	</div>
@endsection