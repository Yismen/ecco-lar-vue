@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Employees '.$title, 'page_description'=>'These Employes Are Actives and Are '.$title])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h4>
                            Employees {{ $title }} <span class="badge">{{ $employees->total() }}</span>
                            <a href="/admin/human_resources" class="pull-right"><i class="fa fa-dashboard"></i></a>
                        </h4>
                    </div>

                    <div class="box-body">
                        @if ($employees->isEmpty())
                            {{-- expr --}}
                        @else
                            <div class="table-responsive">
                                <table class="table table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Position - Project</th>
                                            <th>
                                                <a href="/admin/human_resources/employees/{{ $refresh }}"><i class="fa fa-refresh"></i> Refresh</a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $employee)
                                            <tr>
                                                <td>{{ $employee->id }}</td>
                                                <td>{{ $employee->full_name }}</td>
                                                <td>{{ $employee->position->department->department }} - {{ $employee->position->name }}</td>
                                                <td>
                                                    <a href="/admin/employees/{{ $employee->id }}/edit" target="">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <div class="box-footer">
                        {{ $employees->render() }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop