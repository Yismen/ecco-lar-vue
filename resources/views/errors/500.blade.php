@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'500 Error Page', 'page_description'=>'Sad thing!'])

@section('content')
  <div class="container-fluid">
      <div class="row">
      <div class="col-sm-8 col-sm-offset-2">
        <div class="box box-primary pad big-box">
          <div class="error-page">
            <h2 class="headline text-red"> 500</h2>

            <div class="error-content">
              <h3><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h3>

              <p>
                We will work on fixing that right away.
                Meanwhile, you may <a href="/">return to home page</a> or notify the administrator about it.
              </p>
            </div>
            <!-- /.error-content -->
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection