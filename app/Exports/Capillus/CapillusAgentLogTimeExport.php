<?php

namespace App\Exports\Capillus;

use App\Repositories\Capillus\CapillusDailyLogTimeRepository;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CapillusAgentLogTimeExport implements FromArray, WithHeadings, ShouldAutoSize
{
    protected $repo;

    protected $campaign;

    protected $from;

    protected $to;

    public function __construct($campaign, $from, $to)
    {
        $this->repo = new CapillusDailyLogTimeRepository;

        $this->campaign = $campaign;
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * Data
     *
     * @return array
     */
    public function array(): array
    {
        return $this->repo->report($this->campaign, $this->from, $this->to);
    }

    /**
     * Headings
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Agent ID',
            'Last Name',
            'First Name',
            'Username',
            'Phone',
            'Login DTS',
            'Logout DTS',
            'Dial Group',
            'Presented',
            'Accepted',
            'Manual No Connect',
            'RNA',
            'Disp Xfers',
            '%Calls Xfered',
            'Talk Time (min)',
            'Avg Talk Time (min)',
            'Login Time (min)',
            'Login Utilization',
            'Off Hook Time (min)',
            'Rounded OH Time (min)',
            'Off Hook Utilization',
            'Off Hook to Login %',
            'Work Time (min)',
            'Break Time (min)',
            'Away Time (min)',
            'Lunch Time (min)',
            'Training Time (min)',
            'Pending Disp Time (min)',
            'Avg Pending Disp Time',
            'External Agent ID',
            'Calls Placed On Hold',
            'Time On Hold (min)',
            'Ring Time (min)',
            'EngagedTime (min)',
            'RNA Time (min)',
            'Available Time (min)',
            'Team',
            'Login Session ID',
            'Monitoring Sessions', 
        ];
    }
}
