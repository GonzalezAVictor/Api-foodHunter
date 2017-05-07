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

    public function createRestaurant(Request $request)
    {
    	try {
            $restaurant = new Restaurant($request->all());
            $restaurant->save();
            return Response::json([], 201);
        } catch (Exception $e) {
            return Response::json([], 400); //TODO: definir bien el codigo de respuesta
        }
    }

}
