@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Production Hours', 'page_description'=>'Manage production hours.'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary pad">
                    <div class="container">
                        <div class="row">
                            @include('production-hours._search-form')
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 container">
                            @include('production-hours._results2')
                            
                        </div>
                            
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @section('scripts')
        <script type="text/javascript">
            (function($){
                
                // $('#search-production-hours').myFormSubmit();   
            })(jQuery);
        </script>
    @endsection
@stop