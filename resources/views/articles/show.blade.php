@extends('layouts.main')

@section('content')
    <header>
        <div class="jumbotron">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                    <h2>
                        {{ strtoupper($article->title) }}  
                        @if( Auth::check() && $article->username == Auth::user()->username )
                            <small class="pull-right">( 
                                <a href="{{ route('articles.edit', $article->slug) }}" class="">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                )
                            </small>
                        @endif
                    </h2>

                    <h5>
                        Published by <a href="{{ route('admin.profiles.show', $article->username)}}">{{ $article->user->name }}</a>,
                        <i class="fa fa-clock-o"></i> {{ Carbon\Carbon::parse($article->published_at)->diffForHumans() }},
                        <i class="fa fa-comment"> </i> <a href="{{ route('articles.show', $article->slug) }}#disqus_thread">Comments</a>
                    </h5>
                    <br>
                    @include( 'articles._pager' )
                </div>
            </div>
        </div>
    </header>
    
    <div class="container-fluid">
        <div class="col-sm-10 col-sm-offset-1">
            <!-- Preview Image -->
            @if (strlen($article->main_image)>0 )
                <img class="img-responsive" src="{{ asset($article->main_image) }}" alt="" width="100%">
            @endif

            @if ($article->excert)
                <blockquote class="bs-callout-primary">
                    {{ $article->excert }}
                </blockquote>
            @endif
            <div class="article-body">
                {!! $article->body !!}
            </div>
            <hr>
            @unless ($article->tags->isEmpty())                      
                Associated with Tags:
                @foreach ($article->tags as $tag)
                    <a href="{{ route('tags.show', $tag->name) }}#articles-container" class="label label-primary">{{ $tag->name }}</a>
                @endforeach
                <hr>
            @endunless
            {{-- /. Tags --}}
            <div class="text-center">
                <a href="{{ route('articles.index') }}" class="btn btn-info">
                    <i class="fa fa-angle-double-left"></i> Back to Articles
                </a>
            </div>
            @include( 'articles._pager' )
            {{-- /. Pager --}}
            <hr>
            <div class="row">
                <div class="col-sm-4">
                    <img class="img-circle img-responsive img-center img-thumbnail" src="{{ url($article->user->profile->photo) }}" alt="">
                </div>
                <div class="col-sm-8">
                    <h3><a href="{{ route('admin.profiles.show', $article->user->username) }}">{{ strtoupper($article->user->name) }}</a></h3>
                    <p>{{ mb_substr($article->user->profile->bio, 0, 300) }} ...</p>
                </div>
            </div>
            <hr>
            {{-- /.Share --}}
            <!-- Article Comments -->       
            <div id="disqus_thread"></div>
            
            @include( 'articles._pager' )
        </div>
    </div>
   
  
@stop

@push('scripts')
    @include('layouts.partials.disqus')
@endpush