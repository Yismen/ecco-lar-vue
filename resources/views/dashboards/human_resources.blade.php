@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Dashboard', 'page_description'=>'Human Resources\' Dashboard.'])

@section('content')
<div class="col-xs-12">
    @include('dashboards._filters')
</div>

<div class="row">
    <div class="col-xs-12">
        @include('dashboards.human_resources._infoboxes')
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="col-xs-12 col-lg-9 col-lg-push-3">
            <div class="row">
                         
                <div class="col-lg-12">
                    <div class="box box-primary">
                        <div class="box-header">HC / Attrition</div>
                        <div class="box-body no-padding">
                            <bar-base-chart
                            :labels="{{ collect($attrition_monthly['labels']) }}"
                            :datasets="{{ collect($attrition_monthly['datasets']) }}"
                            ></bar-base-chart>
                        </div>
                    </div>
                </div>
                {{-- /. Chart --}}  
                @include('dashboards.human_resources._charts')
            </div>
        </div>
        <div class="col-xs-12 col-lg-3 col-lg-pull-9" >
            @include('dashboards.human_resources._birthdays_and_issues')
        </div>
    </div>
</div>
@stop

@section('scripts')
@stop