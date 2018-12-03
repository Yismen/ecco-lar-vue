@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'List of Nationalities'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border"><h2>Nationalities</h2></div>

                    <div class="box-body">
                        <table class="table table-condensed table-borderedw">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Employees</th>
                                    <th>
                                        <a href="/admin/nationalities/create">
                                            <i class="fa fa-plus"></i> Create
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nationalities as $nationality)
                                    <tr>
                                        <td>
                                            <a href="/admin/nationalities/{{ $nationality->id }}">{{ $nationality->name }}</a>
                                        </td>
                                        <td>
                                            <span class="label {{ $nationality->employees->count() ? 'label-info' : 'label-default' }}">
                                                {{ $nationality->employees->count() }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="/admin/nationalities/{{ $nationality->id }}/edit" class="">
                                                <i class="fa fa-edit"></i> Edit
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
@endsection
@section('scripts')

@stop