<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\User;
use Exception;
use Response;

class FollowedRestaurantsController extends Controller
{
    public function followRestaurant(Request $request)
    {
        $userId = $this->getCurrentUser()->id;
        $restaurant = Restaurant::find($request['restaurantId']);
        if ($restaurant == null) {
            $response =  $this->createErrorResponse(['message' => 'El restaurante con el id '.$request['restaurant_id'].' no existe']);
            return response($response)->setStatusCode(404);
        }
        $restaurant->users()->syncWithoutDetaching([$userId]);
        return Response::json([], 200);
    }

    public function unfollowRestaurant(Request $request)
    {
        $userId = $this->getCurrentUser()->id;
        $restaurant = Restaurant::find($request['restaurantId']);
        if ($restaurant == null) {
            $response =  $this->createErrorResponse(['message' => 'El restaurante con el id '.$request['restaurantId'].' no existe']);
            return response($response)->setStatusCode(404);
        }
        $restaurant->users()->detach($userId);
        return Response::json([], 200);
    }

    public function restaurantsFollowedByUser($id)
    {
        $user = User::find($id);
        $followedRestauranrs = $user->restaurants();
        $response = $this->createCollectionRestaurantResponse($followedRestauranrs);
        return response($response)->setStatusCode(200);
    }
}
