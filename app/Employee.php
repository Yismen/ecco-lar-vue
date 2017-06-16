<?php namespace App;

use App\Ars;
use App\Afp;
use App\Position;
use Carbon\Carbon;
use App\Department;
use App\CivilStatus;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model 
{

	protected $fillable = [
		'first_name',
		'second_first_name',
		'last_name',
		'second_last_name',
		'hire_date',
		'personal_id',
		'passport',
		'date_of_birth',
		'cellphone_number',
		'secondary_phone',
		'gender_id',
		'marital_id',
		'has_kids',
		'position_id',
		'supervisor_id',
		'photo',
	];
	/**
	 * Fields to be converted to Carbon instances
	 * @var Carbon Instance
	 */
	protected $dates = ['hire_date', 'date_of_birth'];

	/**
	 * attributes appended to each query
	 * @var object
	 */
	protected $appends = [
		'active', 
		'full_name', 
		'status', 
		'systems_list', 
		'termination_type_list', 
		'termination_reason_list', 
		'ars_list', 
		'afp_list', 
		'genders_list', 
		'maritals_list', 
		'has_kids_list', 
		'positions_list', 
		'supervisors_list',
		'banks_list',
	];

	protected $guarded = [];

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
	public function ars()
	{
		return $this->belongsTo('App\Ars');
	}

	public function afp()
	{
		return $this->belongsTo('App\Afp');
	}

	public function bankAccount()
	{
	    return $this->hasOne('App\BankAccount');
	}

	public function socialSecurity()
	{
	    return $this->hasOne('App\SocialSecurity');
	}

	public function department()
	{
		return $this->belongsToMany('App\Department');
	}
	
	public function gender()
	{
		return $this->belongsTo('App\Gender', 'gender_id');
	}
	
	public function nationality()
	{
		return $this->belongsTo('App\Nationality');
	}
	
	public function position()
	{
		return $this->belongsTo('App\Position', 'position_id');
	}
	
	public function marital()
	{
		return $this->belongsTo('App\Marital', 'marital_id');
	}
	
	public function addresses()
	{
		return $this->hasOne('App\Address', 'employee_id');
	}

	public function productions()
	{
		return $this->hasMany('App\Production');
	}

	public function hours()
	{
		return $this->hasMany('App\Hour');
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

	public function supervisor()
	{
	    return $this->belongsTo('App\Supervisor');
	}
/**
 * ------------------------------------------------------
 * Scopes
 * -------------------------------------------------------
 */
	public function scopeActives($query)
	{
		return $query->has('termination', false);
	}

	public function scopeHiredSince($query, $date)
	{
		$date = Carbon::parse($date);

		return $query->where('hire_date', '<=', $date);
	}

	public function scopeActiveSince($query, $date)
	{
		$date = Carbon::parse($date);

		return $query->where('hire_date', '<=', $date)
			->where(function($query){
				$query->has('termination', false);
			});

	}

	/**
	 * Determine if an employee was active on a given date.
	 * @param  [query] $query DB query builder chaining
	 * @param  [string as date] $date  A date like string to parsed with Carbon
	 * @return [query]        returns the query builder chaining.
	 */		
	public function scopeWasActiveOrTerminatedBefore($query, $date)
	{
		$date = Carbon::parse($date);

		return $query->where('hire_date', '<=', $date)
			->where(function($query) use ($date){
				$query->has('termination', false)
					->orWhereHas('termination', function($query) use ($date){
						$query->where('termination_date', '>=', $date);
					});
			});
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

	public function getArsListAttribute()
	{
		return Ars::lists('name', 'id');
	}

	public function getAfpListAttribute()
	{
		return Afp::lists('name', 'id');
	}

	public function getSupervisorsListAttribute()
	{
		return \App\Supervisor::lists('name', 'id')->toArray();
	}

	public function getBanksListAttribute()
	{
		return \App\Bank::lists('name', 'id')->toArray();
	}

	public function getCurrentSupervisorAttribute()
	{
		return $this->supervisor()->lists('id')->toArray();
	}

	public function getSystemsListAttribute()
	{
		return \App\System::lists('display_name', 'id');
	}

	public function getPhotoAttribute($photo)
	{
		return $photo == '' ? 'http://placehold.it/300x300' : $photo;
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
		$name = $this->first_name . ' ' . $this->second_first_name . ' ' . $this->last_name. ' ' . $this->second_last_name;
		return ucwords(trim(mb_strtolower($name)));
	}

	/**
	 * Return a new instance for the date
	 * @param  [type] $date [description]
	 * @return [type]       [description]
	 */
	// public function getHireDateAttribute($date)
	// {
	// 	return Carbon::parse($date)->format('Y-m-d h:i:s');
	// }

	// public function getDateOfBirthAttribute($date)
	// {
	// 	return Carbon::parse($date)->format('Y-m-d h:i:s');
	// }

	/**
	 * Convert the Date of birth to date
	 * @param  datetime $date employee date of birth
	 * @return datetime       an instance of carbon
	 */
	// public function getDateOfBirthAttribute($date)
	// {
	// 	return Carbon::parse($date)->format('Y-m-d');
	// }

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
	public function getFirstNameAttribute($name)
	{
		return ucwords(mb_strtolower($name));
	}

	public function getSecondFirstNameAttribute($name)
	{
		return ucwords(mb_strtolower($name));
	}

	/**
	 * convert the First Name to UC Words
	 * @param  String $first_name Employee First name
	 * @return String             Converted to ucwords
	 */
	public function getLastNameAttribute($name)
	{
		return ucwords(mb_strtolower($name));
	}

	public function getSecondLastNameAttribute($name)
	{
		return ucwords(mb_strtolower($name));
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
	public function getPositionsListAttribute()
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

	public function setSecondFirstNameAttribute($second_first_name)
	{
		$this->attributes['second_first_name'] = ucwords(trim($second_first_name));
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

	public function setSecondLastNameAttribute($second_last_name)
	{
		$this->attributes['second_last_name'] = ucwords(trim($second_last_name));
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

	/**
	 * Methods
	 */
	
	public function computedSalary()
	{
		$base_salary = 8310;
		if ($this->position && $this->position->salary ) {
			// if ($this->position->payment->payment_type == 'By-Weekly') {
			// 	return $this->position->salary * 2;
			// };

			// if ($this->position->payment->payment_type == 'Monthly') {
			// 	return $this->position->salary;
			// };
			if ($this->position->salary > $base_salary) {
				return $this->position->salary;
			};
		}
		return $base_salary;
	}

	public function vacationsStarts()
	{
		// $yeards_to = 
		return $this->hire_date->addYears(1);
	}

	public function vacationsEnds()
	{
		$days = $this->vacationsStarts()->diffInYears(Carbon::today()) >= 5 ? 21 : 14;
		return $this->vacationsStarts()->addWeeks($days);
	}
	
	public function activesOn($date)
	{
		$date = Carbon::parse($date)->format("Y-m-d");

		return $this->where('hire_date', "<=", $date)
			->with(['termination'=>function($query){
				return $query->where('termination_date', '>=', $date);
			}])
			->get();

	}
	public function activesOnYear($year)
	{
		return $this->whereYear('hire_date', "<=", $year)->with(['termination'=>function($query){
			return $query->where('termination_date', '>=', '2012-02-09');
		}])->get();

	}

	public function name()
	{
		
	}

	public function inactivate(Carbon $carbon)
	{
		///// under construction
		return $this->termination()->save([
			'termination_date'=>$carbon->now(),
			'termination_type_id'=>$carbon->now(),
			'termination_reason_id'=>$carbon->now(),
			'can_be_rehired'=>$carbon->now(),
			]);
	}



	public function createOrUpdateAddress($request)
	{
		$address = [
			'sector'         => $request->input('sector'),
			'street_address' => $request->input('street_address'),
			'city'           => $request->input('city'),
			];

		if ($this->addresses) {
			$this->addresses->update($address);

			return $this;
		}
		
		$newAddress = new Address($address);
		$this->addresses()->save($newAddress);

		return $this;
	}

	public function createOrUpdateCard($request)
	{
		$newCard = ['card'=>$request->input('card')];
		
		if ($this->card) {
			$this->card()->update($newCard);
			return $this;
		}

		$card = new Card($newCard);
		$this->card()->save($card);
		return $this;
	}

	public function createOrUpdatePunch($request)
	{
		$newPunch = ['punch'=>$request->input('punch')];
		
		if ($this->card) {
			$this->punch()->update($newPunch);
			return $this;
		}

		$card = new Punch($newPunch);
		$this->punch()->save($card);
		return $this;
	}
	/**
	 * cheks if the current employeed 
	 * @return string or null 'Masculine'
	 */
	function isMasculine()
	{
		return $this->has('gender') && $this->gender->gender == 'Masculine' ? 'Masculine' : null;
	}

	function isFemenine()
	{
		return $this->has('gender') && $this->gender->gender == 'Femenine' ? 'Femenine' : null;
	}

	function isOfGender($gender, $return_value = null)
	{
		if ($this->has('gender') && strtolower($this->gender->gender) == strtolower($gender)) {
			if ($return_value) {
				return $return_value;
			}
			return $gender;
		}

		return null;
	}
}
