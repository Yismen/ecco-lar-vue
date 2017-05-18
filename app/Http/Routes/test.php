<?php

Route::get('test-vue', 'TestController@vue');

Route::get('api/test-vue', 'TestController@apiVueUsers');
Route::post('api/test-vue', 'TestController@apiVue');

