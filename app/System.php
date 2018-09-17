<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    protected $fillable = ['name', 'display_name', 'description', 'url'];

    /**
     * ------------------------------------------
     * Relationships
     */
    public function logins()
    {
        return $this->hasMany('App\Login');
    }
}
