@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Employees', 'page_description'=>"Edit data for employee $employee->first_name $employee->last_name."])

@section('content')
	<div class="container-fluid">
		<div class="col-sm-10 col-sm-offset-1">
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
						            <a href="#termination" aria-controls="termination" role="tab" data-toggle="tab">Termination</a>
						        </li>
						        <li role="presentation">
						            <a href="#card_and_punch_div" aria-controls="card_and_punch_div" role="tab" data-toggle="tab">Card And Punch</a>
					            </li>    
					            <li role="presentation">
						            <a href="#tss_div" aria-controls="tss_div" role="tab" data-toggle="tab">TSS</a>
					            </li>
						        <li role="presentation" class="pull-right">
						        	<a href="{{ route('admin.employees.index') }}"  role="tab" title="Return to the employees' list."><i class="fa fa-list"></i></a>
						        </li>
						        <li role="presentation">
						            <a href="#logins" aria-controls="logins" role="tab" data-toggle="tab">Logins</a>
						        </li>
						        <li role="presentation">
						            <a href="#bank_acc" aria-controls="bank_acc" role="tab" data-toggle="tab">Bank Acc</a>
						        </li>
						        <li role="presentation">
						            <a href="#others" aria-controls="others" role="tab" data-toggle="tab">Others</a>
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
						    
						        <div role="tabpanel" class="tab-pane" id="termination">
						        	@include('employees.partials.termination')
						        </div><!-- /. Edit Info -->
						    
						        <div role="tabpanel" class="tab-pane" id="card_and_punch_div">
							        <div class="col-sm-6">
							        	@include('employees.partials.punch_div')
							        </div>
							        <div class="col-sm-6">
							        	@include('employees.partials.card_div')
							        </div>
						        </div><!-- /. Edit Info -->
						    
						        <div role="tabpanel" class="tab-pane" id="tss_div">
						        	@include('employees.partials.tss')
						        </div><!-- /. TSS Info -->
						    
						        <div role="tabpanel" class="tab-pane" id="logins">
						        	@include('employees.partials.logins')
						        </div><!-- /. Edit Info -->
						    
						        <div role="tabpanel" class="tab-pane" id="bank_acc">
						        	@include('employees.partials.bank_account')
						        </div><!-- /. Bank Account -->
						    
						        <div role="tabpanel" class="tab-pane" id="others">
						        	@include('employees.partials.others')
						        </div><!-- /. Edit Info -->

						    </div><!-- /. Tab Contents -->

						</div><!-- /. Tab Panel -->

						<div class="form-group">
							<a href="{{ route('admin.employees.show', $employee->id) }}">
								<i class="fa fa-angle-double-left"></i> 
								Cancel and go to details!
							</a>
						</div>
					</div>
				</div><!-- /. sm 12 -->
			</div><!-- /. Primary box -->
		</div><!-- /. Main box -->
	</div>
@endsection

@section('scripts')
	<script src="/js/dainsys/app.js"></script>
@stop

