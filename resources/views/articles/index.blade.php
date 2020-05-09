@extends('layouts.main', ['header'=>'User Profile'])

@section('content')
    @unless (isset( $_GET['page']))
        <header class="articles-header">
            <div class="blur">
                <div class="row">
                    <div class="text-center">
                        <h1 class="text-center articles-header-title">Dainsys BlogSpot</h1>
                        <hr class="small">
                        <div class="articles-header-sub-title">
                            Designed for your pleasure...
                        </div>

                        <button onClick="$('.articles').animatescroll()" type="button" class="blogs-button btn btn-primary btn-lg">Read Articles <i class="fa fa-angle-double-down"></i></button>
                       {{--  <button onClick="$(document).scrollTo($('.articles'), {duration:500})" type="button" class="blogs-button btn btn-primary btn-lg">Read Articles</button> --}}
                </div>
            </div>
        </header>
    @endunless 

	<div class="articles container" id="articles-container">
        <!-- Blog Entries Column -->
        <div class="col-sm-8 col-sm-offset-2">
            <div class="row well">
                <div class="col-sm-12 articles-nav pull-right">
                    <div class="navbar text-center">
                        @if (Auth::check())
                            <div class="">
                                <ul class="nav navbar navbar-nav navbar-defaults">
                                    <li>
                                        <a href="{{ route('articles.create') }}" class="">
                                            <i class="fa fa-plus"></i>
                                            Create
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('unpublished') }}" class="">
                                            <i class="fa fa-calendar"></i>
                                            Unpublished
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                        {!! Form::open(['route' => 'articles.search', 'method' => 'get', 'id'=>'search_form', 'class' => 'navbar-form navbar-right']) !!}
                            <div class="input-group">
                                {!! Form::input('search', 'search', null, ['class'=>'form-control', 'id'=>'search', 'placeholder'=>'Search by part of title or body']) !!}
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                </span>
                            
                            </div>
                        {!! Form::close() !!} 
                    </div>
                </div>
            </div>
            {{-- /. Navigation Bar --}}
           <div class="articles-content">
               @include('articles._results')
           </div>
        </div>
    </div>
@stop

@push('scripts')
   <script src="{{ asset('plugins/animatescroll/animatescroll.min.js') }}"></script>
   <script src="{{ asset('plugins/jquery.scrollfixed-master/jquery.scrollfixed.js') }}"></script>
	
    <script>
        // $('.articles-nav').scrollFixed({backgroundcolor: "#E2E2E2", left: "50px"});
    </script>

    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES * * */
        var disqus_shortname = 'dainsys';

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
        }());
    </script>

    <script src="{{ asset('js/scripts/articles.js') }}"></script>


@endpush
