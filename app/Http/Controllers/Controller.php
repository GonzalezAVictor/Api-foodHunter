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
use App\Transformer\UserTransformer;
use App\Transformer\PromotionTransformer;
use App\Transformer\CategoryTransformer;
use App\Transformer\RestaurantUserTransformer;
use League\Fractal;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getCurrentRestaurant()
    {
        $token = \JWTAuth::decode(\JWTAuth::getToken())->toArray();
        $restaurant = Restaurant::find($token['credentials']['id']);
        return $restaurant;
    }

    public function getCurrentUser()
    {
        $user = \JWTAuth::parseToken()->authenticate();
        return $user;
    }

    public function createErrorResponse(Array $error)
    {
        $fractal = new Manager();
        $resource = new Fractal\Resource\Item($error, new ErrorTransformer());
        return $fractal->createData($resource)->toArray();
    }

    public function createItemRestaurantResponse(Restaurant $restaurant)
    {
    	$fractal = new Manager();
        $resource = new Fractal\Resource\Item($restaurant, new RestauranTrasformer());
        return $fractal->createData($resource)->toArray();
    }

    public function createCollectionRestaurantResponse($restaurants)
    {
    	$fractal = new Manager();
        $resource = new Fractal\Resource\Collection($restaurants, new RestauranTrasformer());
        return $fractal->createData($resource)->toArray();
    }

    public function createCollectionUserResponse($user)
    {
        $fractal = new Manager();
        $resource = new Fractal\Resource\Collection($user, new UserTransformer());
        return $fractal->createData($resource)->toArray();
    }

    public function createItemUserResponse($users)
    {
        $fractal = new Manager();
        $resource = new Fractal\Resource\Item($users, new UserTransformer());
        return $fractal->createData($resource)->toArray();
    }

    public function createItemCategoryResponse($category)
    {
        $fractal = new Manager();
        $resource = new Fractal\Resource\Item($category, new CategoryTransformer());
        return $fractal->createData($resource)->toArray();
    }

    public function createCollectionCategoryResponse($categories)
    {
        $fractal = new Manager();
        $resource = new Fractal\Resource\Collection($categories, new CategoryTransformer());
        return $fractal->createData($resource)->toArray();
    }

    public function createItemPromotionResponse($promotion)
    {
        $fractal = new Manager();
        $resource = new Fractal\Resource\Item($promotion, new PromotionTransformer());
        return $fractal->createData($resource)->toArray();
    }

    public function createCollectionPromotionResponse($promotions)
    {
        $fractal = new Manager();
        $resource = new Fractal\Resource\Collection($promotions, new PromotionTransformer());
        return $fractal->createData($resource)->toArray();
    }

    public function createItemRestaurantUserResponse($user)
    {
        $fractal = new Manager();
        $resource = new Fractal\Resource\Item($user, new RestaurantUserTransformer());
        return $fractal->createData($resource)->toArray();
    }

    public function truncArray($response, $columns)
    {
        $truncatedArray = [];
        for ($i=0; $i < sizeof($response['data']); $i++) {
            $tempArray = [];
            foreach ($columns as $column) {
                $tempArray[$column] = $response['data'][$i][$column];
            }
            $truncatedArray['data'][] = $tempArray;
        }
        return $truncatedArray;
    }

}
