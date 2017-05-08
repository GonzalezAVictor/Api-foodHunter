<?php
namespace App\Transformer;

use App\Restaurant;
use League\Fractal;

class RestauranTrasformer extends Fractal\TransformerAbstract
{
	public function transform(Restaurant $restaurant)
	{
	    return [
	        'id' => (int) $restaurant->id,
	        'name' => $restaurant->name,
	        'openAt' => $restaurant->openAt,
	        'closeAt' => $restaurant->closeAt,
	        'ubication' => $restaurant->ubication,
	        'slogan' => $restaurant->slogan,
	        'description' => $restaurant->description,
	    ];
	}
}