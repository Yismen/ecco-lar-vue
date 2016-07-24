<?php namespace App;

use App\CivilStatus;
use App\Department;
use App\Position;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model {

	protected $fillable = [
		'first_name',
		'last_name',
		'hire_date',
		'personal_id',
		'date_of_birth',
		'cellphone_number',
		'secondary_phone',
		'gender_id',
		'marital_id',
		'has_kids',
		'position_id',
		'photo',
	];

	protected $dates = ['hire_date', 'date_of_birth'];

	protected $appends = ['active', 'full_name', 'status'];

	protected $guarded = [];

	protected $genders = [
		['id'=>1, 'name'=>'Male'],
		['id'=>2, 'name'=>'Female'],
	];

	protected $maritals = [
		['id'=>1,'name'=>'Married'],
		['id'=>2,'name'=>'Single'],
		['id'=>3,'name'=>'Free Joint'],
	];


/**
 * ------------------------------------------------------
 * Relationships
 * -------------------------------------------------------
 */

	/**
	 * many to many relationship with the department model
	 *
	 * @return [array] [departments related to current Employee]
	 */
	public function department()
	{
		return $this->belongsTo('App\Department');
	}
	
	public function genders()
	{
		return $this->belongsTo('App\Gender', 'gender_id');
	}
	
	public function positions()
	{
		return $this->belongsTo('App\Position', 'position_id');
	}
	
	public function maritals()
	{
		return $this->belongsTo('App\Marital', 'marital_id');
	}
	
	public function addresses()
	{
		return $this->hasOne('App\Address', 'employee_id');
	}

	public function logins()
	{
		return $this->hasMany('App\Login');
	}

	public function card()
	{
		return $this->hasOne('App\Card');
	}

	public function punch()
	{
		return $this->hasOne('App\Punch');
	}

	public function termination()
	{
		return $this->hasOne('App\Termination');
	}
/**
 * ------------------------------------------------------
 * Scopes
 * -------------------------------------------------------
 */
	public function ScopeActives($query)
	{
		return $query->has('termination', false);
	}

	public function scopeInactives($query)
	{
		return $query->has('termination');	
	}

	public function scopeMissingCard($query)
	{
		return $query->has('card', false);
	}

/**
 * ------------------------------------------------------
 * Accessors
 * -------------------------------------------------------
 */
	/**
	 * return a list array of the systems, including name and id
	 * @return array a list of systems registered.
	 */
	public function getSystemsListAttribute()
	{
		return \App\System::lists('display_name', 'id');
	}
	
	/**
	 * determine if the user is active or inactive
	 * @return string user status
	 */
	public function getStatusAttribute()
	{
		$status = 'Active';

		if($this->termination) $status = 'Inactive';

		return $this->status = $status;
	}

	/**
	 * set the active attribute
	 * @return 	boolean   if user has termination
	 */	
	public function getActiveAttribute()
	{
		return $this->termination == false;
	}

	/**
	 * Concatanets firs name and last name attributes
	 * @return 	string 	first and last names joint by space
	 */
	public function getFullNameAttribute()
	{
		return ucwords(trim($this->attributes['first_name'] . ' ' . $this->attributes['last_name']));
	}

	/**
	 * Return a new instance for the date
	 * @param  [type] $date [description]
	 * @return [type]       [description]
	 */
	public function getHireDateAttribute($date)
	{
		return Carbon::parse($date)->format('Y-m-d');
	}

	/**
	 * Convert the Date of birth to date
	 * @param  datetime $date employee date of birth
	 * @return datetime       an instance of carbon
	 */
	public function getDateOfBirthAttribute($date)
	{
		return Carbon::parse($date)->format('Y-m-d');
	}

	/**
	 * define the attribute can be rehired
	 * @return boolean whether or not the
	 */
	public function getCanBeRehiredAttribute()
	{
		return $this->termination ? $this->termination->can_be_rehired : null;
	}

	public function getTerminationDateAttribute()
	{
		return !$this->termination ? Carbon::now()->format('Y-m-d') : Carbon::parse($this->termination->termination_date)->format('Y-m-d');
	}

	public function getTerminationTypeIdAttribute()
	{
		return $this->termination ? $this->termination->terminationType->id : null;
	}

	public function getTerminationTypeListAttribute()
	{
		return $this->termination ? $this->termination->terminationType->lists('name', 'id') : \App\TerminationType::lists('name', 'id');
	}

	public function getTerminationReasonIdAttribute()
	{
		return $this->termination ? $this->termination->terminationType->id : null;
	}

	public function getTerminationReasonListAttribute()
	{
		return $this->termination ? $this->termination->terminationReason->lists('reason', 'id') : \App\TerminationReason::lists('reason', 'id');
	}

	/**
	 * convert the First Name to UC Words
	 * @param  String $first_name Employee First name
	 * @return String             Converted to ucwords
	 */
	public function getFirstNameAttribute($first_name)
	{
		return ucwords($first_name);
	}

	/**
	 * convert the First Name to UC Words
	 * @param  String $first_name Employee First name
	 * @return String             Converted to ucwords
	 */
	public function getLastNameAttribute($last_name)
	{
		return ucwords($last_name);
	}

	/**
	 * list the has kids attribute
	 *
	 * @return array
	 */
	public function getHasKidsListAttribute()
	{
		return ['0'=> 'No', '1'=>'Yes'];
	}

	public function getDepartmentsListAttribute()
	{
		return Department::lists('department', 'id');
	}

	/**
	 * List all the Genders model
	 *
	 * @return [array] [description]
	 */
	public function getGendersListAttribute()
	{
		return Gender::lists('gender', 'id');
	}

	public function getMaritalsListAttribute()
	{
		return Marital::lists('name', 'id');
	}

	/**
	 * List all the departments
	 *
	 * @return array [description]
	 */
	public function getPositionsIdListAttribute()
	{
		return \App\Position::lists('name', 'id');
	}

/**
 * ------------------------------------------------------
 * Mutators
 * -------------------------------------------------------
 */

	/**
	 * transform the first name attribute before saving to the database
	 * @param [string] $first_name [employee's first name]
	 */
	public function setFirstNameAttribute($first_name)
	{
		$this->attributes['first_name'] = ucwords(trim($first_name));
	}

	/**
	 * trim and change to ucwords the last name before saving to the database
	 *
	 * @param [string] $last_name [employee's last name]
	 */
	public function setLastNameAttribute($last_name)
	{
		$this->attributes['last_name'] = ucwords(trim($last_name));
	}

	/**
	 * make sure date of birth is saved as an instance of carbon
	 * 
	 * @param [type] $date_of_birth [description]
	 */
	public function setHireDateAttribute($hire_date)
	{
		$this->attributes['hire_date'] = Carbon::parse($hire_date);
	}

	/**
	 * make sure date of birth is saved as an instance of carbon
	 * 
	 * @param [type] $date_of_birth [description]
	 */
	public function setDateOfBirthAttribute($date_of_birth)
	{
		$this->attributes['date_of_birth'] = Carbon::parse($date_of_birth);
	}
}
