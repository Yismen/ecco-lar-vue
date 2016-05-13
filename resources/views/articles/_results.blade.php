<hr>   
@unless ($articles->isEmpty())
    @foreach ($articles as $article)        
        <article align="center">
            <h3 class="article-title text-primary">
                <a href="{{ route('articles.show', $article->slug )}}" class="text-primary">{{ ucwords($article->title) }}</a>
                @if( Auth::check() && $article->username == Auth::user()->username )                
                    <small class="pull-right">( 
                        <a href="{{ route('articles.edit', $article->slug) }}" class="">
                            <i class="fa fa-pencil"></i>
                        </a>
                        )
                    </small>
                @endif
            </h3>
            <div>
                Posted by <a href="{{ route('admin.profiles.show', $article->username)}}">{{ $article->user['name'] }}</a>, 
                 <i class="fa fa-clock-o"></i> 
                {{ Carbon\Carbon::parse($article->published_at)->diffForHumans() }},                 
                <i class="fa fa-comment"> </i> <a href="{{ route('articles.show', $article->slug) }}#disqus_thread" class="text-primary">Comments</a>

                <br>
                @unless ( $article->tags->isEmpty() )
                    <h4 class="text-info">Associated with Tags:</h4>

                    @foreach ($article->tags as $tag)        
                        <a href="{{ route('tags.show', $tag->name) }}#articles-container" class="label label-info">{{ $tag->name }}</a>
                    @endforeach
                    <br>
                @endunless
                {{-- /. Tags --}}
                @if ( count_chars($article->excert) > 0 )                        
                    {{-- {{ dd($article->main_image) }} --}}
                    <div class="row">
                        <div class="col-sm-4 col-sm-push-8">  
                            @if (strlen($article->main_image)>0 ) 
                                <img class="img- img-circle" src="{{ asset($article->main_image) }}" alt="" height="120px">
                            @endif
                        </div>
                        <div class="excert col-sm-8 col-sm-pull-4"  align="justify">
                            {{ $article->excert }}
                        </div>
                    </div>
                @endif
                {{-- /. Excert --}}
                <br>
                <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-primary">Read Article <i class="fa fa-angle-double-right"></i></a>
        </article>
        <hr>
    @endforeach
@else
    <div class="jumbotron">
        
        <p class="text-danger"><h1 class="">Oops! No articles found with the criteria provided</h1></p>
    </div>
@endunless
<!-- Pager -->
<div class="text-center">
    {!! $articles->render() !!}
</div>