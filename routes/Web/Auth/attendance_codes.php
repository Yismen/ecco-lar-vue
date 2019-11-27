<?php

Route::resource('attendance_codes', 'AttendanceCodesController')
    ->except(['create', 'show']);
