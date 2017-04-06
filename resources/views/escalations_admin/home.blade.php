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
    @yield('dashboard_scripts')
@stop