<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeOfHour extends Model {

	/**
     * mass assignable
     */
    protected $fillable = ['type',  'display_name'];

}
