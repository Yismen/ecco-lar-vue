@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Escalations Hours Details'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h2>
                            Details 
                            <a href="{{ route('admin.escalations_hours.index') }}" class="pull-right" title="Back to List"><i class="fa fa-list"></i></a>
                        </h2>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-condensed table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Worked By</th>
                                        <th>Client</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                        <th>Minutes Break</th>
                                        <th>Total</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hours as $hour)
                                        <tr class="{{ $hour->production_hours < 0 ? 'danger': '' }}">
                                            <td>{{ $hour->user->name }}</td>
                                            <td>{{ $hour->client->name }}</td>
                                            <td>{{ $hour->entrance }}</td>
                                            <td>{{ $hour->out }}</td>
                                            <td>{{ $hour->break }}</td>
                                            <td>{{ number_format($hour->production_hours, 2) }}</td>
                                            <td>
                                                <a href="{{ route('admin.escalations_hours.edit', $hour->id) }}">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="box-footer">
                        {{ $hours->render() }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop