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
	        'email' => $restaurant->email,
	        'description' => $restaurant->description,
	        'times_visited' => $restaurant->times_visited,
	        'times_random' => $restaurant->times_random,
	        'promotions' => $restaurant->promotions()->get(),
	        'categories' => $restaurant->categories()->get(),
	    ];
	}
}