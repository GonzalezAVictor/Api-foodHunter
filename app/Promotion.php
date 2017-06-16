<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    
	protected $table = 'promotions';

	protected $fillable = [
		'name',
		'details',
		'startAt',
		'endAt',
		'promotion_type',
		'amount_available',
		'restaurant_id'
	];

	public function users() {
		return $this->belongsToMany('App\User')->withTimestamps();
	}

	public function restaurant() {
		return $this->belongsTo('App\Restaurant');
	}

	public function category()
	{
		return $this->hasOne('App\category');
	}

}
