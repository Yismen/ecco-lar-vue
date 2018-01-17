@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Termination Reasons'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4>
                            Termination Reasons 
                            <a href="{{ route('admin.termination_reasons.create') }}" class="pull-right"><i class="fa fa-plus"></i> Create</a>
                        </h4>
                    </div>

                    <div class="box-body">

                        <div class="table-responsive">
                            <table class="table table-condensed table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $reasons as $reason)
                                        <tr>
                                            <td>{{ $reason->reason }}</td>
                                            <td>{{ $reason->description }}</td>
                                            <td>
                                                <a href="{{ route('admin.termination_reasons.edit', $reason->id) }}">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
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