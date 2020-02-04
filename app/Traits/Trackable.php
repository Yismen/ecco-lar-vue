<?php

namespace App\Traits;

use App\User;
use Exception;

/**
 * summary
 */
trait Trackable
{
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            $model->recordChanges();
        });
    }

    protected function recordChanges()
    {
        if (! auth()->check()) {
            abort(405, 'Trackable trait requires authenticated users');
        }

        $this->changes()->create($this->getDiff());
    }

    protected function getDiff()
    {
        $after = $this->getDirty();

        return [
            'user_id' => auth()->user()->id,
            'before' => json_encode(array_intersect_key($this->fresh()->toArray(), $after)),
            'after' => json_encode($after)
        ];
    }

    public function changes()
    {
        return $this->morphMany('App\Track', 'trackable')->latest()->take(35);
    }
}
