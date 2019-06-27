@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'Downtime Reasons'])

@section('content')
    <div class="container-fluid">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="box box-primary">
                <div class="box-header">
                    <h4>
                        Downtime Reasons
                        <a href="{{ route('admin.downtime_reasons.create') }}" class="pull-right">
                            <i class="fa fa-plus"></i>
                            Add
                        </a>
                    </h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($downtime_reasons as $reason)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.downtime_reasons.show', $reason->id) }}">{{ $reason->name }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.downtime_reasons.edit', $reason->id) }}" class="text-warning">
                                                <i class="fa fa-pencil"></i>
                                                Edit
                                            </a>
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
@stop

@section('scripts')

@stop
