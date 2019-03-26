<?php

Route::bind('campaign', function ($id) {
    return App\Campaign::with(['project', 'revenueType'])
        ->findOrFail($id);
});

Route::resource('campaigns', 'CampaignsController');
