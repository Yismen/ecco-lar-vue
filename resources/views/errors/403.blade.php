@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'403 Error Page', 'page_description'=>'Sad thing!'])

@section('content')
  <div class="container-fluid">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <div class="box box-primary pad big-box">
            <div class="box-body">
              <div class="error-page">
                <h2 class="headline text-red"> 403</h2>

                <div class="error-content">
                  <h3><i class="fa fa-warning text-red"></i> Forbiden!</h3>

                  <p>
                    <a href="{{ url()->previous() }}">Go Back to where you came from!</a> or notify the administrator about it.
                  </p>

                  <p>{{ session('danger') }}</p>
                </div>
                <!-- /.error-content -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
