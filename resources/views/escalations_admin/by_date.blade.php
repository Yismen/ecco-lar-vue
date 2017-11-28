@extends('escalations_admin.home')

@section('views')
    
    <div class="col-sm-6">
        @include('escalations_admin.partials._by_date_day_form')
    </div>

    <div class="col-sm-6">
        @include('escalations_admin.partials._by_date_range_form')
    </div>

    @if (isset($clients) && isset($users) && isset($summary))
        <hr>    

        <div class="col-sm-12">
            <div class="page-header">Results for Date [{{ Request::old('date') }}] </div>
        </div>
    @endif
    @include('escalations_admin.partials._by_date_summary_table')
    @include('escalations_admin.partials._by_date_clients_table')
    @include('escalations_admin.partials._by_date_users_table')
    @include('escalations_admin.partials._by_date_detailed_table')
@stop