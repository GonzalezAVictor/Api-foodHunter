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
            $response =  $this->createErrorResponse(['message' => 'El restaurante con el id '.$id.' no existe']);
            return response($response)->setStatusCode(404);
        }
        $restaurant->users()->syncWithoutDetaching([$userId]);
        return Response::json([], 200);
    }

    public function unfollowRestaurant(Request $request)
    {
        $userId = $request->userId;
        $restaurant = Restaurant::find($request['restaurant_id']);
        if ($restaurant == null) {
            $response =  $this->createErrorResponse(['message' => 'El restaurante con el id '.$id.' no existe']);
            return response($response)->setStatusCode(404);
        }
        $restaurant->users()->detach($userId);
        return Response::json([], 200);
    }

    public function restaurantsFollowedByUser($id)
    {
        $user = User::find($id);
        $user->restaurants();
        return Response::json(['data' => $user->restaurants], 200);
    }
}
