<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'status'
    ];

    /**
     * Add a single condition, or an array of conditions to the WHERE clause of the query.
     * 
     * @param   mixed   $conditions  A string or array of where conditions.
     * @return  JDatabaseQuery  Returns this object to allow chaining.
     * @since   1.0
     */
    public function users() {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

}
