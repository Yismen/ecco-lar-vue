@if($notes->count() > 0)
	@foreach ($notes as $note)
		<h3>
			{{ $note->title }} 
			@if (auth()->check())
				<a href="{{ route('admin.notes.edit', $note->slug) }}">
					<i class="fa fa-pencil"></i>
				</a>
			@endif
		</h3>
		<p>{!! $note->body !!}</p>
		@if (count($note->tagList) > 0)							
			<p>Tags: 
				@foreach ($note->tagList as $tag)
					<span class="label label-info">{{ ucfirst(trim($tag)) }}</span>
				@endforeach
			</p>
		@endif
		<hr>
	@endforeach
@else
	<h1 class="alert alert-info">Nothing found. Please search again!</h1>
@endif