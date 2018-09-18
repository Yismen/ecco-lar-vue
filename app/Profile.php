<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['gender', 'bio', 'photo', 'phone', 'education', 'skills', 'work', 'location'];

    /**
     * ==========================================
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ======================================
     * Accessors
     */
    public function getSkillsArrayAttribute()
    {
        return explode(',', $this->skills);
    }

    public function getSkillsObjectAttribute()
    {
        $returned = [];
        $skills = explode(',', $this->skills);

        foreach ($skills as $skill) {
            array_push($returned, ucwords(trim($skill)));
        }

        return (object)$returned;
    }

    /**
     * ========================================
     * Methods
     */

    /**
     * ==========================================
     * Scopes
     */
    public function scopeNotCurrent($query)
    {
        return $query->where('id', '<>', $this->id);
    }

    /**
     * =======================================
     * Mutators
     */
}
