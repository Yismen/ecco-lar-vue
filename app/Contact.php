<?php

namespace App;

use App\DainsysModel as Model;
use Illuminate\Database\Eloquent\Builder;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = ['user_id', 'name', 'phone', 'works_at', 'position', 'secondary_phone', 'email'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        /**
         * Hide contacts not owed by current user
         */
        static::addGlobalScope('user', function (Builder $builder) {
            if (auth()->check()) {
                $builder->whereUserId(auth()->user()->id);
            }
        });
    }

    /**
     * A contact belongs to a user
     *
     * @return relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accesor: morph the attribute before it is retrieved.
     *
     * @param string $work
     * @return mutated
     */
    public function getWorksAtAttribute($work)
    {
        return ucwords(trim($work));
    }

    /**
     * mutate the position attribute after it is retrieved
     *
     * @param string $position
     * @return mutated
     */
    public function getPositionAttribute($position)
    {
        return ucwords(trim($position));
    }

    /**
     * Mutate the name attribute before it is inserted.
     *
     * @param string $name
     * @return mutated attribute
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucwords(trim($name));
    }
}
