@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Page not foud', 'page_description'=>'Sorry!'])

@section('content')
      <div class="col-sm-8 col-sm-offset-2">
        <div class="box box-primary pad">
          <div class="error-page">
            <h2 class="headline text-yellow"> 404</h2>

            <div class="error-content">
              <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

              <p>
                We could not find the page you were looking for.
                Meanwhile, you may <a href="/">return to home page</a>.
              </p>
            </div>
            <!-- /.error-content -->
          </div>
        </div>
      </div>
@endsection