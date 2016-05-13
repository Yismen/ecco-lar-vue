<link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('plugins/select2/select2-bootstrap.css') }}"> --}}
<script src="{{ asset('plugins/select2/dist/js/select2.full.min.js') }}"></script>
<script>
	$(document).ready(function() {
		$('#tag_list').select2({
			placeholder:'Select one or multiple tags',
			tags:true
		});
		$('#title').focus();
	});
</script>

{{-- Display Errors --}}
@if( $errors->any() )
	<div class="col-sm-12">
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	</div>
@endif

{!! Form::hidden('username') !!}
{{-- /. Errors --}}
<div class="form-group form-group-sm {{ $errors->has('title') ? 'has-error' : null }}">
	{!! Form::label('title', 'Article Title:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'title', null, ['class'=>'form-control']) !!}
	</div>
</div>
{{-- /. Title --}}
<div class="form-group {{ $errors->has('body') ? 'has-error' : null }}">
	{!! Form::label('body', 'Article Body', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::textarea('body', null, ['class'=>'form-control']) !!}
	</div>
</div>
{{-- Article Body --}}
<div class="form-group {{ $errors->has('excert') ? 'has-error' : null }}">
	{!! Form::label('excert', 'Article Excert:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::textarea('excert', null, ['class'=>'form-control', 'rows'=>5]) !!} 
	</div>
</div>
{{-- Article Excert --}}
<div class="form-group form-group-sm {{ $errors->has('main_image') ? 'has-error' : null }}">
	{!! Form::label('main_image', 'Main Image Route', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'main_image', null, ['class'=>'form-control', 'readonly'=>'readonly']) !!}
		@if ($article->slug)
			<br>			
			<button class="btn btn-primary btn-xs" type="button" data-toggle="modal" href='#modal-from-file'><i class="fa fa-hdd-o"></i> Create From Local Disk</button>
			<button class="btn btn-primary btn-xs" type="button" data-toggle="modal" href='#modal-from-url'><i class="fa fa-globe"></i> Create from URL</button>
		@else
			<span class="help-block">Adding images is only avaiable when editing a article. To get this feature, save the article and then edit it...!</span>
		@endif
	</div>
</div>
{{-- /. Main Image Route --}}
<div class="form-group form-group-sm {{ $errors->has('published_at') ? 'has-error' : null }}">
	{!! Form::label('published_at', 'Date to be Published:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('date', 'published_at', $article->published_at->format('Y-m-d'), ['class'=>'form-control']) !!}
		<span class="help-block">The article will be published at the date and time set</span>
	</div>
</div>

{{-- Date to be Published --}}
<div class="form-group form-group-sm {{ $errors->has('tag_list') ? 'has-error' : null }}">
	{!! Form::label('tag_list', 'Tags', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
			{!! Form::select('tag_list[]', $tags, null, ['class'=>'form-control', 'multiple'=>"multiple", 'id'=>'tag_list'])!!}
	</div>
</div>

<div class="form-group form-group-sm">
	<div class="col-xs-offset-1">
		{!! Form::button('Save', ['type'=>'submit', 'class'=>'btn btn-primary']) !!} /
		{!! HTML::linkRoute('articles.index', 'Return to Articles') !!}
	</div>
</div>

