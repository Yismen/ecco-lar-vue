@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Shifts', 'page_description'=>'Control shift items'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="panel-title">
                            Shifts
                            <a href="{{ route('admin.shifts.create') }}" class="pull-right">
                                <i class="fa fa-plus"></i>
                                 Add Shift Item
                            </a>
                        </h3>
                    </div>
                    {{-- .box-bheader --}}
                    <div class="box-body">
                        <table class="table table-bordered table-condensed table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shifts as $shift)
                                    <tr>
                                        <td>{{ $shift->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.shifts.edit', $shift->id) }}" class="text-warning">
                                                <i class="fa fa-pencil"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- .box-body --}}
                </div>
                {{-- .box --}}
            </div>
        </div>
    </div>
@endsection
