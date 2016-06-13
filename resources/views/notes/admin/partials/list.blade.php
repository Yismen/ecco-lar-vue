@if (count($notes) > 0)
<table class="table table-condensed table-hover table-stripped">
	<thead>
		<tr>
			<th>Title</th>
			<th>
				<a href="{{ route('admin.notes.create') }}" class="text-centered"><i class="fa fa-plus"></i></a>
			</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($notes as $note)
			<tr>
				<td>
					<a href="{{ route('admin.notes.show', $note->slug) }}">
						{{ $note->title }}
					</a>
				</td>

				<td>
					<div class="btn-group">
						<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Actions <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li>
								<a class="text-danger" href="{{ route('admin.notes.show', $note->slug) }}">
									<span class="text-info"><i class="fa fa-eye"></i> View</span>
								</a>
							</li>
							<li>
								<a class="text-danger" href="{{ route('admin.notes.edit', $note->slug) }}">
									<span class="text-warning"><i class="fa fa-pencil"></i> Edit</span>
								</a>
							</li>
							<li>
								{!! deleteFormLink('admin.notes.destroy', $note->slug, ['btn-text' => ' Remove']) !!}
							</li>
						</ul>
					</div>
				</td>

			</tr>
		@endforeach
	</tbody>
</table>

{{-- {{ $notes->render() }} --}}

@else
{{-- false expr --}}
@endif				
