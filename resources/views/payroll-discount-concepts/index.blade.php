@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Payroll Discount Concepts'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3>
                            Discount Concepts 
                            <a href="{{ route('admin.payroll-discount-concepts.create') }}" class="pull-right"><i class="fa fa-plus"></i> Add</a>
                        </h3>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-condensed table-bordered">
                                <thead>
                                    <tr>
                                        <th>Concept</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($concepts as $concept)
                                        <tr>
                                            <td>{{ $concept->name }}</td>
                                            <td>
                                                <a href="{{ route('admin.payroll-discount-concepts.edit', $concept->id) }}"><i class="fa fa-edit"></i> Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="box-footer"></div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop