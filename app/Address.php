<?php

namespace App;

use App\DainsysModel as Model;

class Address extends Model
{
    protected $fillable = ['employee_id', 'sector', 'street_address', 'city'];

    protected $table = 'addresses';

    /**
     * -------------------------------------------------------------------
     * Relatioships
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function setSectorAttribute($sector)
    {
        return $this->attributes['sector'] = ucwords(trim($sector));
    }

    public function setStreetAddressAttribute($street_address)
    {
        return $this->attributes['street_address'] = ucwords(trim($street_address));
    }

    public function setCityAttribute($city)
    {
        return $this->attributes['city'] = ucwords(trim($city));
    }
}
