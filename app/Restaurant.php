<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    
	protected $table = 'restaurants';

	protected $fillable = [
	'name',
	'openAt',
	'closeAt',
	'ubication',
	'slogan',
	'description',
	'email',
	'password'
	];

	public function categories() {
		return $this->belongsToMany('App\Category')->withTimestamps();
	}

    public function users() {
    	return belongsToMany('App\User')->withTimestamps();
    }

    public function promotions() {
    	return $this->hasMany('App\Promotion');
    }

}
