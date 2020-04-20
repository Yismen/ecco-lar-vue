<?php

namespace App\Repositories;

use App\Employee;

class AttritionRepository
{
    public static function monthly(int $months = 12)
    {
        $static = new self();
        $data = [];

        for ($i = $months - 1; $i >= 0; $i--) { 
            $date = now()->subMonths($i);
            $actives = $static->activesStartOfMonth($i);
            $terminations = $static->terminatedThisMonth($i);
            $data[] =  [
                'month' => $date->format('Y-m'),
                'head_count' => $actives,
                'terminations' => $terminations,
                'attrition' => $static->calculate($terminations, $actives),
            ];
        }

        return $data;       
    }

    /**
     * Calculate MTD attrition for any given month. 0 means, current month. 1 means last month. 
     *
     * @param integer $months
     * @return void
     */
    public static function mtd(int $months = 0)
    {
        $static = new self();

        return $static->calculate(
            $static->terminatedThisMonth( $months), $static->activesStartOfMonth( $months)
        );
    }

    public static function activesStartOfMonth(int $months = 0):int
    {
        $static = new self();
        $start_of_month = now()->subDay()->subMonths($months)->startOfMonth();

        return Employee::where('hire_date', '<=', $start_of_month)->filter(request()->all())
            ->where(function ($query) use ($start_of_month) {
                $query->actives()
                ->orWhereHas('termination', function ($query) use ($start_of_month) {
                    $query->where('termination_date', '>', $start_of_month );
                });
            })->count();
    }

    public static function terminatedThisMonth(int $months = 0):int
    {
        $start_of_month = now()->subDay()->subMonths($months);

        return Employee::with('termination')->filter(request()->all())
            ->whereHas('termination', function ($query) use ($start_of_month) {
                return $query->whereYear('termination_date', $start_of_month->year)
                    ->whereMonth('termination_date', $start_of_month->month);
            })->count();
    }

    public static function hiredThisMonth(int $months = 0):int
    {
        $start_of_month = now()->subDay()->subMonths($months);

        return Employee::whereYear('hire_date', $start_of_month->year)->filter(request()->all())
            ->whereMonth('hire_date', $start_of_month->month)->count();
    }

    protected function calculate($terminations, $actives)
    {
        return number_format($actives == 0 ? 0 : $terminations / $actives * 100, 2);
    }
}