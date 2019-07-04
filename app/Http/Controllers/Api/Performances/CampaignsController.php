<?php

namespace App\Http\Controllers\Api\Performances;

use App\Campaign;
use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignResource;

class CampaignsController extends Controller
{
    public function list()
    {
        $campaigns = Campaign::with([
            'project',
            'source',
            'revenueType',
        ])
            ->get();

        return CampaignResource::collection($campaigns);
    }
}
