@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<p>{{ $profiles }}</p>

				{!! $profile->render() !!}
			</div>
		</div>
	</div>
@endsection
