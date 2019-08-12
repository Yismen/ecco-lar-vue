@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Sites Overview', 'page_description'=>"Dashboard."])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                    <div class="box-body">
                        <form action="{{ route('admin.sites-overview-dashboard') }}" method="GET" role="form">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Sites</label>
                                    {{ Form::select('site', $sites_list, null, ['class'=>'form-control']) }}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Projects</label>
                                    {{ Form::select('project', $projects_list, null, ['class'=>'form-control']) }}
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-lg-push-4">
                {{-- Revenue --}}
                <div class="col-sm-6">
                    <div class="box box-primary">
                        <div class="box-body">
                            <sites-metric
                                :info="{{ collect($stats['revenue']) }}"
                                title="Monthly Revenue"
                            ></sites-metric>
                        </div>
                    </div>
                </div>
                {{-- SPH --}}
                <div class="col-sm-6">
                    <div class="box box-primary">
                        <div class="box-body">
                            <sites-sph
                                :info="{{ collect($stats['sph']) }}"
                                title="SPH"
                            ></sites-sph>
                        </div>
                    </div>
                </div>
                {{-- Payroll Hours --}}
                <div class="col-sm-6">
                    <div class="box box-primary">
                        <div class="box-body">
                            <sites-metric
                                :info="{{ collect($stats['login_time']) }}"
                                title="Payroll Hours"
                                background-color="rgba(244,67,54, .25)"
                                border-color="rgba(244,67,54, 1)"
                            ></sites-metric>
                        </div>
                    </div>
                </div>
                {{-- Production Hours --}}
                <div class="col-sm-6">
                    <div class="box box-primary">
                        <div class="box-body">
                            <sites-metric
                                :info="{{ collect($stats['login_time']) }}"
                                title="Production Hours"
                                background-color="rgba(244,67,54, .25)"
                                border-color="rgba(244,67,54, 1)"
                            ></sites-metric>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-lg-pull-8">
                    @foreach ($stats['attrition']['monthly'] as $site => $attrition)
                        <div class="col-lg-12 col-md-6">
                            <monthly-attrition
                                :info="{{ collect($attrition) }}"
                                site="{{ $site }}"
                                ></monthly-attrition>
                        </div>
                    @endforeach

                    @foreach ($stats['rotations']['monthly'] as $site => $rotation)
                        <div class="col-lg-12 col-md-6">
                            <monthly-rotation
                                :info="{{ collect($rotation) }}"
                                site="{{ $site }}"
                                ></monthly-rotation>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>




        <div class="row">

        </div>

    </div>
@stop

@section('scripts')
    <script>
    </script>
@stop

