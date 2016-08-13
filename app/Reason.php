<?php namespace App;

use App\Production;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model {

	public function production( )
    {
        return $this->belongsTo(Production::class);
    }

}
