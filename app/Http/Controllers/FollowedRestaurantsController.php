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
        $userId = $request->userId;
        $restaurant = Restaurant::find($request['restaurant_id']);
        if ($restaurant == null) {
            $response =  $this->createErrorResponse(['message' => 'El restaurante con el id '.$request['restaurant_id'].' no existe']);
            return response($response)->setStatusCode(404);
        }
        $restaurant->users()->syncWithoutDetaching([$userId]);
        return Response::json([], 200);
    }

    public function unfollowRestaurant($userId, $restaurantId)
    {
        $restaurant = Restaurant::find($restaurantId);
        if ($restaurant == null) {
            $response =  $this->createErrorResponse(['message' => 'El restaurante con el id '.$restaurantId.' no existe']);
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
