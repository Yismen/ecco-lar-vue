@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Ars', 'page_description'=>'Details'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary pad">
                    <div class="box-header with-border">
                        <h4>
                            Details for ARS {{ $ars->name }}
                            <a href="{{ route('admin.arss.index') }}" class="pull-right">
                                <i class="fa fa-home"></i> Back to list
                            </a>
                        </h4>
                    </div>
                    <div class="box-body">

                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-star"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">
                                    {{ $ars->name }}
                                    <a href="{{ route('admin.arss.edit', $ars->id) }}"><i class="fa fa-pencil"></i></a>
                                </span>

                                <strong>ID: </strong> {{ $ars->id }} <br>

                                Employees: <span class="info-box-number">{{ count($ars->employees) }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>

                        @if(count($ars->employees))
                            <div class="table-responsive">
                                Employees
                                <table class="table table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Photo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ars->employees as $employee)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admin.employees.show', $employee->id) }}">{{ $employee->id }}</a>
                                                </td>
                                                <td>
                                                    {{ $employee->full_name }}
                                                </td>
                                                <td class="col-xs-2">
                                                    <a href="{{ asset($employee->photo) }}" target="_new">
                                                        <img src="{{ asset($employee->photo) }}" height="30px" alt="Image">
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
