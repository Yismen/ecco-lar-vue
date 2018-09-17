<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = ['user_id', 'task_name', 'completed'];

    protected $guarded = [];

    /**
     * -------------------------------------------------
     * Relationships
     * -------------------------------------------------
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    /**
     * -------------------------------------------------
     * Scopes
     * -------------------------------------------------
     */

    /**
     * Apply order by filter to the query.
     *
     * @param  [object] $query [the query builder object]
     * @return [object]        [the query builder object]
     */
    public function scopeSorted($query)
    {
        $query->orderBy("completed")->orderBy("created_at");
    }

    /**
     * Apply filter to make to only retrieve items if they belongs to the user
     *
     * @param  [object] $query [the query builder object]
     * @return [object]        [the query builder object]
     */
    public function scopeForuser($query)
    {
        $query->whereUser_id(\Auth::id());
    }

    /**
     * Filter the query to only show the tasks that has not been completed
     *
     * @param  [object] $query [the query builder object]
     * @return [object]        [the query builder object]
     */
    public function scopeCompleted($query)
    {
        $query->whereCompleted(1);
    }

    public function scopePending($query)
    {
        $query->whereCompleted(0);
    }

    /**
     * -------------------------------------------------------------
     * Mutators
     * -------------------------------------------------------------
     */
    /**
     * Make sure task_name is always saved as ucfirst
     * @param [type] $task_name [description]
     */
    public function setTaskNameAttribute($task_name)
    {
        $this->attributes['task_name'] = ucfirst(trim($task_name));
        // $this->attributes['task_name'] = ucfirst(strtolower(trim($task_name)));
    }

    /**
     * --------------------------------------------------------------
     * Accessors
     * --------------------------------------------------------------
     */
}
