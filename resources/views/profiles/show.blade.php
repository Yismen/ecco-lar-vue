@extends('layouts.app')

@section('content')

	<div class="container-fluid">
		<div class="col-sm-12">
			<h1>User Profile</h1>
		</div>
		<div class="col-sm-4 text-center">
			<div class="box box-primary pad">
				<div class="center-block ">	
					<img src="{{ file_exists($profile->photo) ? asset($profile->photo) :  'http://placehold.it/300x300'}}" class="img-responsive img-circle center-block profile-user-img animated rotateIn box-shadow" alt="Image">	
				</div>

				<h3>{{ $profile->user->name }}</h3>	
				<h4>{!! $profile->work !!}</h4>	
				<h5><a href="mailto:{{ $profile->user->email }}"></a>{{ $profile->user->email }}</h5>	
				<h5>{{ $profile->phone }}</h5>	

				<div class="form-group">

					@if (auth()->user()->id == $profile->user_id)
						<a class="btn btn-warning" href="{{ route('admin.profiles.edit', $profile->id) }}">
							<i class="fa fa-pencil"></i>
							 Edit
						</a>
					@else
						<a href="{{ route('admin.profiles.show', auth()->user()->profile->id) }}">
							<i class="fa fa-check"></i>
							 Back to Your...
						</a>
					@endif
				</div>
			</div>

			<div class="box box-primary pad">

				<h3>About Me</h3>
				 <div class="accordion" id="accordion">
					
					<!-- Education -->
					<hr>
				 	<div class="accordion-group">
				 		<div class="accordion-heading">
				 			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseEducation">
								<h4><i class="fa fa-book"></i> Education</h4>	
				 			</a>
				 		</div>
				 		<div id="collapseEducation" class="accordion-body collapse">
				 			<div class="accordion-inner">
				 				<p>{!! $profile->education !!}</p>
				 			</div>
				 		</div>
				 	</div>
				 	<!-- /. Education -->
					
					<!-- Skills -->
					<hr>
				 	<div class="accordion-group">
				 		<div class="accordion-heading">
				 			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseSkills">
								<h4><i class="fa fa-book"></i> Skills</h4>	
				 			</a>
				 		</div>
				 		<div id="collapseSkills" class="accordion-body collapse">
				 			<div class="accordion-inner">

								@foreach ($profile->skillsObject as $skill)
									<span class="label label-info" style="margin: 0 3px;">
										{{ trim($skill) }} 
									</span> 
								@endforeach
				 			</div>
				 		</div>
				 	</div>
				 	<!-- /. Skills -->
					
					<!-- Works -->
					<hr>
				 	<div class="accordion-group">
				 		<div class="accordion-heading">
				 			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseWorks">
								<h4><i class="fa fa-book"></i> Works</h4>	
				 			</a>
				 		</div>
				 		<div id="collapseWorks" class="accordion-body collapse">
				 			<div class="accordion-inner">
								<p>{!! $profile->work !!}</p>
				 			</div>
				 		</div>
				 	</div>
				 	<!-- /. Works -->
					
					<!-- Location -->
					<hr>
				 	<div class="accordion-group">
				 		<div class="accordion-heading">
				 			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseLocation">
								<h4><i class="fa fa-book"></i> Location</h4>	
				 			</a>
				 		</div>
				 		<div id="collapseLocation" class="accordion-body collapse">
				 			<div class="accordion-inner">
								<p>{!! $profile->location !!}</p>
				 			</div>
				 		</div>
				 	</div>
				 	<!-- /. Location -->
				 	
				 </div>
				 <!-- /. Accordion -->


			</div>
			
		</div>
		<div class="col-sm-8">
			<div class="box box-primary pad">		

				<h3>More About Me</h3>
				{!! $profile->bio !!} 
			</div>
			
		</div>

		<!-- Show other user's profiles only if multiple -->
		@if (count($profiles) > 0)
			<div class="row">
				<div class="col-sm-12">
					<h3>Ohter Users Profiles </h3>
					<hr>
					@foreach ($profiles as $profile)
						<div class="col-sm-3">
							<div class="box box-warning pad text-center">
								<div class="center-block">	
									<img src="{{ file_exists($profile->photo) ? asset($profile->photo) : 'http://placehold.it/150x150'}}" height="150px" class="img-responsive img-circle center-block profile-user-img animated rotateIn box-shadow" alt="Image">	
								</div>
								<h3>
									<a href="{{ route('admin.profiles.show', $profile->id) }}">{{ $profile->user->name }}</a>
									@if (auth()->user()->id == $profile->user_id)
										<a class="pull-right text-warning" href="{{ route('admin.profiles.edit', $profile->id) }}">
											<i class="fa fa-edit"></i>
										</a>
									@endif
								</h3>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		@endif
	</div>
	
@stop

@section('scripts')
	<script src="">
		(function($){
			$('.collapse').collapse({
				toggle: true
			})
		})(jQuery);
	</script>
@stop