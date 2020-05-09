@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Performances', 'page_description'=>'Edit Performance.'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h4>
                        Delete data for date [{{ $date }}] and file name [{{ $file_name }}]...
                        <a href="/admin/performances_import" class="pull-right" title="Back to the list" style="margin-left: 3px;">
                            <i class="fa fa-list"></i> List
                        </a>
                    </h4>
                </div>

                <div class="box-body">

                    <p class="text-danger">
                        Please make sure before proceeding! This action cant be undone... 
                        All Data for Date [{{ $date }}] and file name [{{ $file_name }}] will be removed from the database.

                    </p>

                </div>

                <div class="box-footer">

                    <delete-request-button 
                        url="/admin/performances_import/dd?date={{ $date }}&file_name={{ $file_name }}" 
                        btn-class="btn btn-danger" 
                        redirect-url="{{ route('admin.performances_import.index') }}"
                    >
                    </delete-request-button>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

@endpush