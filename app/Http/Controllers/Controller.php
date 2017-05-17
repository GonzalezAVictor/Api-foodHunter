<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Restaurant;
// Fractal
use League\Fractal\Manager;
use App\Transformer\RestauranTrasformer;
use App\Transformer\ErrorTransformer;
use League\Fractal;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createErrorResponse(Array $error)
    {
        $fractal = new Manager();
        $resource = new Fractal\Resource\Item($error, new ErrorTransformer());
        return $fractal->createData($resource)->toJson();
    }

    public function createItemRestaurantResponse(Restaurant $restaurant)
    {
    	$fractal = new Manager();
        $resource = new Fractal\Resource\Item($restaurant, new RestauranTrasformer());
        return $fractal->createData($resource)->toJson();
    }

    public function createCollectionRestaurantResponse($restaurants)
    {
    	$fractal = new Manager();
        $resource = new Fractal\Resource\Collection($restaurants, new RestauranTrasformer());
        return $fractal->createData($resource)->toJson();
    }

}
