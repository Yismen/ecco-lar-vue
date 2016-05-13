<div class="btn-group">
	<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Actions <span class="caret"></span></a>
	<ul class="dropdown-menu">
		<li>
			<a class="text-danger" href="{{ route('notes.show', $note->slug) }}">
				<span class="text-info"><i class="fa fa-eye"></i> View</span>
			</a>
		</li>
		<li>
			<a class="text-danger" href="{{ route('notes.edit', $note->slug) }}">
				<span class="text-warning"><i class="fa fa-pencil"></i> Edit</span>
			</a>
		</li>
		<li>
			{!! deleteFormLink('admin.notes.destroy', $note->slug, ['btn-text' => ' Remove']) !!}
		</li>
	</ul>
</div>