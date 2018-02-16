<?php

Route::bind('quality_score', function($id){
	return App\QualityScore::with('auditor', 'client', 'employee')
		->findOrFail($id);
});

Route::resource('quality_scores', 'Quality\ScoreController');




