<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Traits\Mutators\UserMutators;
use App\Http\Traits\Accessors\UserAccessors;
use Illuminate\Contracts\Auth\CanResetPassword;
use App\Http\Traits\Relationships\UserRelationships;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements CanResetPassword
{
    use HasApiTokens, HasRoles,  UserAccessors, UserRelationships, UserMutators, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'is_active', 'is_admin'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::addGlobalScope('active', function(Builder $builder) {
    //         $builder->where('is_active', '=', 1);
    //     });
    // }

    public function owns($model)
    {
        return $this->id == $model->user_id;
    }

    public function userHasProfileOrCreate()
    {
        if (Auth::check()) {
            if (Auth::user()->has('profile')) {
                return $this->profile;
            }
        }
        return false;
    }

    public function isOnline()
    {
        if (Cache::has('online-user-' . $this->id)) {
            return true;
        }
        return false;
    }

    public function createQualityScore($request)
    {
        $unique_id = $request->employee_id . '-' . $request->client_id . '-' . $request->work_date;
        $exists = QualityScore::whereUniqueId($unique_id)->first();

        if ($exists) {
            return back()->withInput()
                ->withDanger(
                    'A score with this criterias exists already. Click <a href="/admin/quality_scores/' . $exists->id . '/edit"> Edit</a> to update instead!'
                );
        }

        $request->merge(['unique_id' => $unique_id]);

        $score = auth()->user()->scores()->create($request->all());
    }
}
