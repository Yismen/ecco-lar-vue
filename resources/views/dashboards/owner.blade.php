@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Dashboard', 'page_description'=>'Owner\'s dashboard.'])

@section('content')
<div class="col-xs-12">
    @include('dashboards.filters._owner-filters')
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="col-xs-6 col-md-4 col-lg-3"> 
            @component('components.info-box',[
                'number' => $employees,
                'color' => 'bg-blue-active',
                'icon' => 'fa fa-users',
            ]) 
                Employees 
            @endcomponent
        </div>

        <div class="col-xs-6 col-md-4 col-lg-3">
            @component('components.info-box',[
                'number' => $revenue_mtd,
                'color' => 'bg-green-active',
                'icon' => 'fa fa-dollar',
                'projected' => true
            ]) 
                MTD Revenue 
            @endcomponent
        </div>

        <div class="col-xs-6 col-md-4 col-lg-3">
            @component('components.info-box',[
                'number' => $login_hours_mtd,
                'color' => 'bg-black',
                'icon' => 'fa fa-chain',
                'projected' => true
            ]) 
                MTD Payroll Hours
            @endcomponent            
        </div>

        <div class="col-xs-6 col-md-4 col-lg-3">
            @component('components.info-box',[
                'number' => $production_hours_mtd,
                'color' => 'bg-blue-active',
                'icon' => 'fa fa-battery-3',
                'projected' => true
            ]) 
                MTD Prod. Hours
            @endcomponent
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        {{-- /. Performance Data --}}            
        <div class="col-lg-6">
            <div class="box box-primary">
                <div class="box-header">Revenue</div>
                <div class="box-body no-padding">
                    <line-base-chart
                    :labels="{{ collect($performance['labels']) }}"
                    :datasets="{{ collect($performance['revenue']) }}"
                    ></line-base-chart>
                </div>
            </div>
        </div>
        {{-- /. Chart --}}            
        <div class="col-lg-6">
            <div class="box box-primary">
                <div class="box-header">Revenue / Hora</div>
                <div class="box-body no-padding">
                    <line-base-chart
                    :goal="8.5"
                    :labels="{{ collect($performance['labels']) }}"
                    :datasets="{{ collect($performance['rph']) }}"
                    ></line-base-chart>
                </div>
            </div>
        </div>
        {{-- /. Chart --}}              
        <div class="col-lg-6">
            <div class="box box-primary">
                <div class="box-header">Payroll Hours</div>
                <div class="box-body no-padding">
                    <line-base-chart
                    :labels="{{ collect($performance['labels']) }}"
                    :datasets="{{ collect($performance['login_time']) }}"
                    ></line-base-chart>
                </div>
            </div>
        </div>
        {{-- /. Chart --}}                
        <div class="col-lg-6">
            <div class="box box-primary">
                <div class="box-header">Production Hours</div>
                <div class="box-body no-padding">
                    <line-base-chart
                    :labels="{{ collect($performance['labels']) }}"
                    :datasets="{{ collect($performance['production_time']) }}"
                    ></line-base-chart>
                </div>
            </div>
        </div>
        {{-- /. Chart --}}                
        <div class="col-lg-6">
            <div class="box box-primary">
                <div class="box-header">Monthly SPH</div>
                <div class="box-body no-padding">
                    <line-base-chart
                    :labels="{{ collect($performance['labels']) }}"
                    :datasets="{{ collect($performance['sph']) }}"
                    ></line-base-chart>
                </div>
            </div>
        </div>
        {{-- /. Chart --}}                
        <div class="col-lg-6">
            <div class="box box-primary">
                <div class="box-header">Hours Efficiency</div>
                <div class="box-body no-padding">
                    <line-base-chart
                    :goal=".9"
                    :labels="{{ collect($performance['labels']) }}"
                    :datasets="{{ collect($performance['efficiency']) }}"
                    ></line-base-chart>
                </div>
            </div>
        </div>
        {{-- /. Chart --}}        
    </div>
</div>
@stop

@section('scripts')
@stop