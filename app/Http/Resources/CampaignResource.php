<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'project_id' => optional($this->project)->id,
            'source_id' => optional($this->source)->id,
            'revenue_type_id' => optional($this->revenueType)->id,
            'sph_goal' => $this->sph_goal,
            'sph_goal' => $this->sph_goal,
            'rate' => $this->revenue_rate,
        ];
    }
}
