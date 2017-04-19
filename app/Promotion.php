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



}
