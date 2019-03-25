<?php

Route::bind('campaign', function ($id) {
    return App\Campaign::findOrFail($id);
});

Route::resource('campaigns', 'CampaignsController');
