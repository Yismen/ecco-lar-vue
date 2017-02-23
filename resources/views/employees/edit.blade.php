@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Employees', 'page_description'=>"Edit data for employee $employee->first_name $employee->last_name."])

@section('content')
	<div class="container">
		<div class="col-sm-12">
			<div class="box box-primary pad">
				<div class="row">
					<div class="col-sm-12">
						<div role="tabpanel">

						    <ul class="nav nav-tabs" role="tablist">
						        <li role="presentation" class="active">
						            <a href="#edit_info" aria-controls="data" role="tab" data-toggle="tab">Edit</a>
						        </li>
						        <li role="presentation">
						            <a href="#address" aria-controls="address" role="tab" data-toggle="tab">Address</a>
						        </li>
						        <li role="presentation">
						            <a href="#user_photo" aria-controls="user_photo" role="tab" data-toggle="tab">Photo</a>
						        </li>
						        <li role="presentation">
						            <a href="#logins" aria-controls="logins" role="tab" data-toggle="tab">Login</a>
						        </li>
						        <li role="presentation">
						            <a href="#termination" aria-controls="termination" role="tab" data-toggle="tab">Termination</a>
						        </li>
						        <li role="presentation">
						            <a href="#card_div" aria-controls="card_div" role="tab" data-toggle="tab">Card ID</a>
						        </li>
						        <li role="presentation">
						            <a href="#punch_div" aria-controls="punch_div" role="tab" data-toggle="tab">Punch ID</a>
						        </li>
						        <li role="presentation" class="pull-right">
						        	<a href="{{ route('admin.employees.index') }}"  role="tab" title="Return to the employees' list."><i class="fa fa-list"></i></a>
						        </li>
						    </ul><!-- /. Tab List -->

						    <div class="tab-content">
						    
						        <div role="tabpanel" class="tab-pane active" id="edit_info">
						        	@include('employees.partials.edit-info')
						        </div><!-- /. Edit Info -->
						    
						        <div role="tabpanel" class="tab-pane" id="address">
						        	@include('employees.partials.address')
						        </div><!-- /. Edit Info -->
						    
						        <div role="tabpanel" class="tab-pane" id="user_photo">
						        	@include('employees.partials.user_photo')
						        </div><!-- /. Edit Info -->
						    
						        <div role="tabpanel" class="tab-pane" id="logins">
						        	@include('employees.partials.logins')
						        </div><!-- /. Edit Info -->
						    
						        <div role="tabpanel" class="tab-pane" id="termination">
						        	@include('employees.partials.termination')
						        </div><!-- /. Edit Info -->
						    
						        <div role="tabpanel" class="tab-pane" id="card_div">
						        	@include('employees.partials.card_div')
						        </div><!-- /. Edit Info -->
						    
						        <div role="tabpanel" class="tab-pane" id="punch_div">
						        	@include('employees.partials.punch_div')
						        </div><!-- /. Edit Info -->

						    </div><!-- /. Tab Contents -->

						</div><!-- /. Tab Panel -->

						<div class="form-group">
							<a href="{{ route('admin.employees.show', $employee->id) }}">
								<i class="fa fa-angle-double-left"></i> 
								Cancel and go to details!
							</a>
						</div>

					</div><!-- /. sm 12 -->
				</div><!-- /. Row -->

			</div><!-- /. Primary box -->
		</div><!-- /. Main box -->
	</div><!-- /. Container -->
@endsection

@section('scripts')
	<script>
		$('#address_form,#card_form,#punch_form,#logins_form').myFormSubmit();
		/**
		 * Photo edit script
		 * @param  {[type]} $ [description]
		 * @return {[type]}   [description]
		 */
		(function($){
			$(document).on('submit', '#photo_form', function(event) {
				event.preventDefault();
				var form = $(this);
				$('.save-photo').append(' <i class="spinner fa fa-circle-o-notch fa-spin"></i>');

				var ajax = $.ajax({
					url: $(form).prop('action'),
					type: $(form).prop('method'),
					dataType: 'json',
					data: new FormData(this),
					processData: false,
					contentType: false,
				})
				.progress(function(data){
					alert(data);
					// console.log(data.total);
				})
				.done(function(results) {
					// console.log(results);
					$(form).fadeTo('fast', .5, function() {
						$('.errors-area').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Success!</strong> '+results.message+' ...</div>');
						$('#photo_form_group')
							.removeClass('has-error');
						$('#show-photo').prop('src', results.photo +"?" + Math.random());

					}).fadeTo('slow', 1);

				})
				.fail(function(results) {
					// console.log(results.responseText);
					$(form).fadeTo('fast', .5, function() {
						$('.errors-area').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Error!</strong> '+results.responseJSON.photo+' ...</div>');
						$('#photo_form_group')
							.removeClass('has-error')
							.addClass('has-error');
					}).fadeTo('slow', 1);
				})
				.complete(function() {
					$('.spinner').fadeOut('fast');
				});
				
				// console.log(ajax);
				
			});
		})(jQuery);

	</script>
@stop

