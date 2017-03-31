@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Escalations Records Admin', 'page_description'=>'Administration session!'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-4">
                    
                    <div class="box box-primary pad">
                        @include('escalations_admin.partials.links')
                    </div>

                </div>

                <div class="col-sm-8">
                    <div class="box box-danger pad">
                            @yield('views')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // (function($) {
        //     // $('#myfirstchart').css('background-color', '#000');
        //     new Morris.Line({
        //   // ID of the element in which to draw the chart.
        //   element: 'myfirstchart',
        //   // Chart data records -- each entry in this array corresponds to a point on
        //   // the chart.
        //   data: [
        //     { year: '2008', value: 20 },
        //     { year: '2009', value: 10 },
        //     { year: '2010', value: 5 },
        //     { year: '2011', value: 5 },
        //     { year: '2012', value: 20 }
        //   ],
        //   // The name of the data record attribute that contains x-values.
        //   xkey: 'year',
        //   // A list of names of data record attributes that contain y-values.
        //   ykeys: ['value'],
        //   // Labels for the ykeys -- will be displayed when you hover over the
        //   // chart.
        //   labels: ['Value']
        // });
        // })(jQuery)
    </script>
@stop