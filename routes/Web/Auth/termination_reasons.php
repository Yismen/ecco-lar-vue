<?php

Route::group([
	'middleware' => 'sd', ['only'=>['index','show']],
	'middleware' => 'authorize:edit_termination_reasons', ['only'=>['edit','update']],
	'middleware' => 'authorize:create_termination_reasons', ['only'=>['create','store']],
	'middleware' => 'authorize:destroy_termination_reasons', ['only'=>['destroy']]
], function() {

	Route::bind('termination_reason', function($id){
		return App\TerminationReason::whereId($id)
			->firstOrFail();
	});

	Route::resource('termination_reasons', 'TerminationReasonController', [
		'middleware' => 'sd', ['only'=>['index','show']],
		'middleware' => 'authorize:edit_termination_reasons', ['only'=>['edit','update']],
		'middleware' => 'authorize:create_termination_reasons', ['only'=>['create','store']],
		'middleware' => 'authorize:destroy_termination_reasons', ['only'=>['destroy']],
	]);

});