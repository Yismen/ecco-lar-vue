@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Dashboard', 'page_description'=>'Owner\'s dashboard.'])

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="col-xs-6 col-md-4 col-lg-3">
            @component('components.info-box',[
                'number' => $users->count(),
                'color' => 'bg-blue',
                'icon' => 'fa fa-users',
                'project' => true
            ]) 
                Users
            @endcomponent            
        </div>  

        <div class="col-xs-6 col-md-4 col-lg-3">
            @component('components.info-box',[
                'number' => $revenue,
                'color' => 'bg-green',
                'icon' => 'fa fa-money',
                'project' => true
            ]) 
                Lifetime Revenue
            @endcomponent            
        </div>  
        
        <div class="col-xs-6 col-md-4 col-lg-3">
            @component('components.info-box',[
                'number' => $revenue_mtd,
                'color' => 'bg-blue',
                'icon' => 'fa fa-money',
                'project' => true
            ]) 
                MTD Revenue
            @endcomponent            
        </div>    
        
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="col-xs-12">
            @include('dashboards.admin._panel')
        </div>
        <div class="row">
            ,<div class="col-xs-12">
                @include('dashboards.admin._oauth')
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
@stop