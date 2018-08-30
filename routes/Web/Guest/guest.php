<?php

Route::get('/{path}', 'HomeController@index')->where('path', '(admin|home|)');
