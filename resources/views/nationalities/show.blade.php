@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Nationality Details'])

@section('content')
    <div class="container-fluid">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4>
                        Nationality Details <i class="fa fa-flag"></i> {{ $nationality->name }}
                        <a href="{{ route('admin.nationalities.index') }}" class="pull-right" title="Back Home">
                            <i class="fa fa-home"></i>
                        </a>
                    </h4>
                </div>

                <div class="box-body">
                    <table class="table table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Photo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nationality->employees as $employee)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.employees.show', $employee->id) }}">
                                            {{ $employee->full_name }}
                                        </a>
                                    </td>
                                    <td>{{ $employee->position ? $employee->position->name_and_department : '' }}</td>
                                    <td class="col-xs-1">
                                        <a href="{{ $employee->photo }}" target="_photo">
                                            <img src="{{ $employee->photo }}" class="img-responsive img-circle" alt="Image">
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="box-footer"></div>
                
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop