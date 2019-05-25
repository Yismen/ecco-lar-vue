<?php

Route::resource('banks', 'BanksController')->except(['show', 'create']);
