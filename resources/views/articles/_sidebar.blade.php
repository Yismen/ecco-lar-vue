<!-- Blog Sidebar Widgets Column -->

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    {!! Form::open(['route' => 'articles.search', 'method' => 'get', 'id'=>'search_form']) !!}
                        <div class="input-group">
                            {!! Form::input('search', 'search', null, ['class'=>'form-control', 'id'=>'search', 'placeholder'=>'Search by part of title or body']) !!}
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                            </span>
                        
                        </div>
                    {!! Form::close() !!} 
                    <!-- /.input-group -->
                </div>
                {{-- /. Search Well --}}
                @if ( Auth::check() )
                    <div class="well">
                        <div class="list-group">
                            <a href="#" class="list-group-item active">Dashboard <i class="fa fa-dashboard"> </i></a>
                            <a href="{{ route('articles.create') }}" class="list-group-item success">Create new post</a>
                            <a href="{{ route('unpublished') }}" class="list-group-item">See your unpublished articles</a>
                        </div>
                    </div>
                @endif
                {{-- /. Dashboard Well --}}
                
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>
                {{-- /. side Widget Well --}}

<script>
    $(document).ready(function() {
        var container = $('.articles-content');

        $(document).on('submit', '#search_form', function(event) {
            event.preventDefault();
            var data = $(this).serializeArray();
            var url = $(this).attr('action');
        
            process( data, container, url );
        });

        function process ( data, container, url ) {
            $.ajax({
                url: '/articles/search',
                type: 'GET',
                dataType: 'html',
                data: data,
            })
            .done(function(results) {
                $(container).fadeOut().html(results).fadeIn();
            });
        }
    });
</script>