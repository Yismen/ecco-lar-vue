@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Campaigns', 'page_description'=>'Details.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-info">
                    <div class="box-header">
                        <h4>
                            {{ $campaign->name }} Details
                            <a href="{{ route('admin.campaigns.index') }}" class="pull-right">
                                <i class="fa fa-home"></i> List
                            </a>
                        </h4>
                    </div>
                    <div class="box-body">
                        {{ $campaign }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush