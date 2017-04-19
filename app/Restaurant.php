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



}
