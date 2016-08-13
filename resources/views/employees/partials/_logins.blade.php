<table class="table table-condensed table-hover table-bordered">
	<thead>
		<tr>
			<th>Login Name</th>
			<th>System</th>
			<th>Edit</th>
		</tr>
	</thead>
	<tbody id="login-body">
		@foreach ($employee->logins as $login)
			<tr>
				<td>{{ $login->login }}</td>
				<td><a href="{{ $login->system->url }}" target="_new">{{ $login->system->display_name }}</a></td>
				<td><a href="{{ route('admin.logins.edit', $login->id ) }}" class=""><i class="fa fa-edit"></i></a></td>
			</tr>						
		@endforeach
	</tbody>
</table>