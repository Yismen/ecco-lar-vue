	<!-- Global Messages to be Printed -->
	@if(Session::has('global'))
		<div class="container-fluid dismiss">
			<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Global <i class="fa fa-info"> </i>!</strong> {{{ Session::get('global') }}}
			</div>
		</div>
	@endif
	<!-- /. Global Messages -->
	<!-- Info Messages to be Printed -->
	@if(Session::has('info'))
		<div class="container-fluid dismiss">
			<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Information <i class="fa fa-info"> </i>!</strong> {{{ Session::get('info') }}}
			</div>
		</div>
	@endif
	<!-- /. Info Messages -->	
	<!-- Success Messages to be Printed -->
	@if(Session::has('success'))
		<div class="container-fluid dismiss">
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Success <i class="fa fa-check-circle"></i> !</strong> {{{ Session::get('success') }}}
			</div>
		</div>
	@endif
	<!-- /. Success Messages -->
	<!-- Danger Messages to be Printed -->
	@if(Session::has('danger'))
		<div class="container-fluid dismiss">
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Danger <i class="fa fa-exclamation-circle"> </i>!</strong> {{{ Session::get('danger') }}}
			</div>
		</div>
	@endif
	<!-- /. Danger Messages -->
	<!-- Warning Messages to be Printed -->
	@if(Session::has('warning'))
		<div class="container-fluid dismiss">
			<div class="alert alert-warning">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Warning <i class="fa fa-exclamation-triangle"></i> !</strong> {{{ Session::get('warning') }}}
			</div>
		</div>
	@endif
	<!-- /. Warning Messages -->