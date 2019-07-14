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
            <div class="col-sm-4">
                <h4>Head Counts</h4>

                @include('human_resources.hc._stats')

            </div>
            {{-- Rotations and Issues --}}
            <div class="col-sm-4">
                <h4>Rotations</h4>
                <div class="row">
                    @foreach ($stats['rotations']['this_month'] as $site => $data)
                        <div class="col-lg-6">
                            <div class="box box-warning">
                                <div class="box-body">
                                    <hc-rotations
                                        :hires="{{ $data['hires'] }}"
                                        :terminations="{{ $data['terminations'] }}"
                                        title="MTD In/Out: {{ $site }}"
                                        go-to-route="{{ route('admin.human_resources.index') }}"
                                    ></hc-rotations>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- last month --}}
                    @foreach ($stats['rotations']['last_month'] as $site => $data)
                        <div class="col-lg-6">
                            <div class="box box-warning">
                                <div class="box-body">
                                    <hc-rotations
                                        :hires="{{ $data['hires'] }}"
                                        :terminations="{{ $data['terminations'] }}"
                                        title="P. Month In/Out: {{ $site }}"
                                        go-to-route="{{ route('admin.human_resources.index') }}"
                                    ></hc-rotations>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- this-year --}}
                    @foreach ($stats['rotations']['this_year'] as $site => $data)
                        <div class="col-lg-6">
                            <div class="box box-warning">
                                <div class="box-body">
                                    <hc-rotations
                                        :hires="{{ $data['hires'] }}"
                                        :terminations="{{ $data['terminations'] }}"
                                        title="YTD In/Out: {{ $site }}"
                                        {{-- go-to-route="{{ route('admin.human_resources.index') }}" --}}
                                    ></hc-rotations>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- last-year --}}
                    @foreach ($stats['rotations']['last_year'] as $site => $data)
                        <div class="col-lg-6">
                            <div class="box box-warning">
                                <div class="box-body">
                                    <hc-rotations
                                        :hires="{{ $data['hires'] }}"
                                        :terminations="{{ $data['terminations'] }}"
                                        title="P. Year In/Out: {{ $site }}"
                                        {{-- go-to-route="{{ route('admin.human_resources.index') }}" --}}
                                    ></hc-rotations>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
                <div class="row">
                    @foreach ($stats['attrition']['monthly'] as $site => $attrition)
                        <div class="col-sm-12">
                            <monthly-attrition
                                :info="{{ collect($attrition) }}"
                                site="{{ $site }}"
                                ></monthly-attrition>
                        </div>
                    @endforeach

                </div>

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

