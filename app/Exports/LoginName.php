<?php

namespace App\Exports;

use App\Employee;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LoginName implements FromView, WithTitle, ShouldAutoSize
{

    public function view(): View
    {
        $employees = Cache::rememberForever('login-names', function() {
            return Employee::select('id', 'first_name', 'second_first_name', 'last_name', 'second_last_name')
            ->orderBy('first_name')->with('loginNames')->whereHas('loginNames')->get();
        });

        return view('login_names.partials.results-to-excel', compact('employees'));
    }

    public function title(): string
    {
        return "Login Names";
    }
}