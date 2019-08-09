@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Human Resources', 'page_description'=>"Dashboard."])

@section('content')
    <div class="container-fluid">
        <div class="row">
            {{-- / Birthdays --}}
            <div class="col-sm-4">
                <h4>Birthdays</h4>
                <div class="row animated-delayed">
                    <div class="col-sm-12">
                        @include('human_resources.birthdays.list_today')
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        @include('human_resources.birthdays.count_this_month')
                    </div>
                    <div class="col-md-6">
                        @include('human_resources.birthdays.count_next_month')
                    </div>
                    <div class="col-md-6">
                        @include('human_resources.birthdays.count_last_month')
                    </div>
                </div>
                <hr>
                <h4>Missing Infos</h4>

                @include('human_resources._issues-table')
            </div>
            {{-- / Head Counts --}}
            <div class="col-sm-8">

                <h4>Rotations</h4>

                <div class="row">
                    @foreach ($stats['attrition']['monthly'] as $site => $attrition)
                        <div class="col-sm-6">
                            <monthly-attrition
                                :info="{{ collect($attrition) }}"
                                site="{{ $site }}"
                                ></monthly-attrition>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    @foreach ($stats['rotations']['monthly'] as $site => $rotation)
                        <div class="col-sm-6">
                            <monthly-rotation
                                :info="{{ collect($rotation) }}"
                                site="{{ $site }}"
                                ></monthly-rotation>
                        </div>
                    @endforeach
                </div>

                <h4>Head Counts</h4>

                @include('human_resources.hc._stats')
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(function () {
            setTimeout(function() {
                $('.animated-delayed').addClass('animated rubberBand')
            }, 1000);
        });
    </script>
@stop

