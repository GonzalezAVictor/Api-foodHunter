<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Response;

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
  	return $this->belongsToMany('App\User')->withTimestamps();
  }

  public function promotions() {
  	return $this->hasMany('App\Promotion');
  }

}
