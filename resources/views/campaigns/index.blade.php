@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Campaigns', 'page_description'=>'List of campaigns of production.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4>
                            Campaigns List
                            <a href="{{ route('admin.campaigns.create') }}" class="pull-right">
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
                                    <th>Project</th>
                                    <th>Revenue Type</th>
                                    <th>SPH Goal</th>
                                    <th>Revenue Rate</th>
                                    <th class="col-xs-2">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($campaigns as $campaign)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.campaigns.show', $campaign->id) }}">{{ $campaign->name }}</a>
                                        </td>
                                        <td>{{ $campaign->project->name }}</td>
                                        <td>{{ $campaign->revenueType->name }}</td>
                                        <td>{{ $campaign->sph_goal }}</td>
                                        <td>${{ $campaign->revenue_rate }}</td>
                                        <td>
                                            <a href="{{ route('admin.campaigns.edit', $campaign->id) }}" class="text-warning">
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