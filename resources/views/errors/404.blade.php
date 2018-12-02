@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Page not foud', 'page_description'=>'Sorry!'])

@section('content')
  <div class="col-sm-8 col-sm-offset-2">
    <div class="box box-primary">
      <div class="box-body">
        <div class="error-page">
          <h2 class="headline text-yellow">404</h2>

          <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

            <p>
              This you are look for does't belong here. Keep searching somewhere else!
              {{-- We could not find the page you were looking for.
              Meanwhile, you may <a href="{{ url()->previous() }}">return to home page</a>. --}}
            </p>

            <p>
              <a href="{{ url()->previous() }}" class="btn btn-default">
                <i class="fa fa-home"></i>
                Go Back
              </a>
            </p>

          </div>
          <!-- /.error-content -->
        </div>
        {{-- /.error page --}}
      </div>
    </div>
  </div>
@endsection