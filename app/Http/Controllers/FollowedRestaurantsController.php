<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use Exception;
use Response;

class FollowedRestaurantsController extends Controller
{
    public function followRestaurant(Request $request)
    {
        $userId = 1;
        $restaurant = Restaurant::find($request['restaurant_id']);
        if ($restaurant == null) {
            return Response::json([], 404);
        }
        $restaurant->users()->syncWithoutDetaching([$userId]);
        return Response::json([], 204);

    }

    public function unfollowRestaurant($userId, $restaurantId)
    {

        $restaurant = Restaurant::find($restaurantId);
        if ($restaurant == null) {
            return Response::json([], 404);
        }
        $restaurant->users()->detach($userId);
        return Response::json([], 200);
    }
}
