@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Sites', 'page_description'=>'List of sites of production.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4>
                            Sites List
                            <a href="{{ route('admin.sites.create') }}" class="pull-right">
                                <i class="fa fa-plus"></i> Add
                            </a>
                        </h4>
                    </div>
                    {{-- .box-header --}}
                    <div class="box-body">
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="col-xs-2">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sites as $site)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.sites.show', $site->id) }}">{{ $site->name }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.sites.edit', $site->id) }}" class="text-warning">
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
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@stop