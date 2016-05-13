@if( $article->isEmpty )
    <div class="jumbotron">
        <h2 class="text-warning">
            Sorry, Article not found!
        </h2>
    </div>
@else

    @include( 'articles._pager' )

    <!-- Article Post -->
    <h3>
        {{ strtoupper($article->title) }} 
        @if( Auth::check() && $article->username == Auth::user()->username )
            <small class="pull-right">( 
                <a href="{{ route('articles.edit', $article->slug) }}" class="">
                    <i class="fa fa-pencil"></i>
                </a>
                )
            </small>
        @endif
    </h3>
    <p class="lead">
        Published by <a href="{{ route('admin.profiles.show', $article->username)}}">{{ $article->user->name }}</a>,
        <i class="fa fa-clock-o"></i> {{ Carbon\Carbon::parse($article->published_at)->diffForHumans() }},
        <i class="fa fa-comment"> </i> <a href="{{ route('articles.show', $article->slug) }}#disqus_thread">Comments</a>
      
    </p>
    <!-- Date/Time -->

    <hr>

    <!-- Preview Image -->
    @if (strlen($article->main_image)>0 )
        <img class="img-responsive" src="{{ $article->main_image }}" alt="" height="150px">
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
        <a href="{{ route('articles.index') }}" class="btn btn-info"><i class="fa fa-angle-double-left">Back to All Articles</i></a>
    </div>
    @include( 'articles._pager' )
    {{-- /. Pager --}}
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <img class="img-circle img-responsive img-center" src="{{ asset($article->user->profile->photo) }}" alt="">
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
    
@endif
