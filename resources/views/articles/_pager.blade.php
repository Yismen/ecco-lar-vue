<ul class="pager">
    @if( $article->previous )
        <li class="previous">
            {!! link_to_route('articles.show', '&larr; Older', $article->previous->slug, ['id'=>'pager_link']) !!}
        </li>
    @endif
    @if( $article->next )
        <li class="next">
            {!! link_to_route('articles.show', 'Newer &rarr;', $article->next->slug, ['id'=>'pager_link']) !!}
        </li>
    @endif
</ul>


