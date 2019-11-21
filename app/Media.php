<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'size', 'url', 'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id'
    ];

    /**
     * Add a single condition, or an array of conditions to the WHERE clause of the query.
     * 
     * @param   mixed   $conditions  A string or array of where conditions.
     * @return  JDatabaseQuery  Returns this object to allow chaining.
     * @since   1.0
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

}
