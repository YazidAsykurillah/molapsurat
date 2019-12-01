<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

	protected $fillable = ['slug', 'description'];
	
    public function roles(){

    	return $this->belongsToMany('App\Role');
    }
}
