@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Hours'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">    
                        <h4>
                            Hours Management
                            <a href="{{ route('admin.hours-import.index') }}" class="pull-right"><i class="fa fa-upload"></i> Import</a>
                        </h4>
                    </div>

                    <div class="box-body">
                        <div class="col-sm-12">
                            <h4><i class="fa fa-dashboard"></i> Imported Dates</h4>
                            <div class="row">
                                @foreach ($dates as $date)
                                    <div class="col-sm-3">
                                        <div class="alert alert-info">
                                            <a href="{{ route('admin.hours.by-date', $date->date->format("Y-m-d")) }}">
                                                <i class="fa fa-calendar"></i> 
                                                {{ $date->date->format("M-d-Y") }}
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        {{ $dates->render() }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush