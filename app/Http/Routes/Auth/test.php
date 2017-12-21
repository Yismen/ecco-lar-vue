<?php
use Yajra\Datatables\Datatables;
use App\User;
Route::get('test-vue', 'TestController@vue');

Route::get('api/test-vue', 'TestController@apiVueUsers');
Route::post('api/test-vue', 'TestController@apiVue');

Route::get('test/pagination', function() {
    return view('test.pagination');
});
Route::get('api/test/pagination', function() {
    return App\User::paginate(1);
});

Route::get('test/datatables', function() {
    return view('test.datatables');
});
Route::post('api/test/datatables', function() {
    return Datatables::of(User::get())->make(true);
});



