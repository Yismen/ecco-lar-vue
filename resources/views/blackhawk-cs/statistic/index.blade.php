@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'BlackHaws Statistic Dashboard'])

@section('content')
    <div class="container-fluid">
        <div class="isotope col-lg-3 col-md-4 col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4>QA Errors Reports</h4>
                </div>
                <div class="box-body">
                    @if ($statistics && $statistics->qa_error_dates)
                        <table class="table table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statistics->qa_error_dates as $error)
                                    <tr>
                                        <td>{{ $error->date }}</td>
                                        <td>Delete</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
        <div class="isotope col-lg-3 col-md-4 col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4>QA Reports </h4>
                </div>
                <div class="box-body">
                    @if ($statistics && $statistics->qa_dates)
                        <table class="table table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statistics->qa_dates as $date)
                                    <tr>
                                        <td>{{ $date->date }}</td>
                                        <td>Delete</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        
                    @endif
                </div>
            </div>
        </div>
        <div class="isotope col-lg-3 col-md-4 col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4>LOB Reports</h4>
                </div>
                <div class="box-body">
                    @if ($statistics && $statistics->lob_dates)
                        <table class="table table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statistics->lob_dates as $lob)
                                    <tr>
                                        <td>{{ $lob->date }}</td>
                                        <td>Delete</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
        <div class="isotope col-lg-3 col-md-4 col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4>Performance Reports</h4>
                </div>
                <div class="box-body">
                    @if ($statistics && $statistics->performance_dates)
                        <table class="table table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statistics->performance_dates as $performance)
                                    <tr>
                                        <td>{{ $performance->date }}</td>
                                        <td>Delete</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
<script>
    var elem = document.querySelector('.container-fluid');
    var iso = new Isotope( elem, {
        // options
        itemSelector: '.isotope',
        layoutMode: 'masonry',
        masonry: {
            columnWidth: '.col-lg-3.col-md-4.col-sm-6',
        }
    });
    iso.layout()

    console.log(iso)
</script>
@stop