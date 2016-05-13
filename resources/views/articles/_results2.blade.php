 {!! $articles->render() !!}
<hr>
@unless ($articles->isEmpty())
    @foreach ($articles as $article)
        
        <article>
            @if ($article->main_image)
                <div class="col-sm-6">
                    <img class="img-responsive" src="{{ $article->main_image }}" alt="" height="150px">
                </div>
            @endif
            <h3 align="center">
                <a href="{{ route('articles.show', $article->slug )}}">{{ ucwords($article->title) }}</a>
                @if( Auth::check() && $article->username == Auth::user()->username )
                    <small>( {!! HTML::linkRoute('articles.edit', ' Edit', [$article->slug]) !!} )</small>
                @endif
            </h3>

            {!! str_limit($article->body, 400, '...')  !!}
            <br>
            <a class="btn btn-primary" href="{{ route('articles.show', $article->slug )}}">Read More <i class="fa fa-angle-right"></i></a>
            <p class="">
                by <a href="{{ route('admin.profiles.show', $article->username)}}">{{ $article->user['name'] }}</a>,
                <i class="fa fa-clock-o"></i> 
                Posted {{ Carbon\Carbon::parse($article->published_at)->diffForHumans() }}
                , 
                <span class="fb-comments-count" data-href="{{ route('articles.index', $article->slug) }}/" data-version="v2.3"></span> Comments 
                <br>
                @unless ( $article->tags->isEmpty() )
                    Associated with Tags:
                    @foreach ($article->tags as $tag)                                    
                        {!! link_to_route('tags.show', $tag->name, $tag->name, ['class'=>'label label-primary']) !!}
                    @endforeach
                @endunless
                {{-- /. Tags --}}
            </p>
        </article>

        
    <hr>
    @endforeach
@else
    <h3>No Articles found with the criteria provided</h3>
@endunless
<!-- Pager -->
{!! $articles->render() !!}