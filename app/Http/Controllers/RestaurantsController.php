<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use Exception;
use Response;

class RestaurantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        return Response::json(['data' => $restaurants]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $restaurant = new Restaurant($request->all());
            $restaurant->save();
            return Response::json([], 204);
        } catch (Exception $e) {
            return Response::json([], 400); //TODO: definir bien el codigo de respuesta
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant = Restaurant::find($id);
        if ($restaurant == null) {
            return Response::json([], 404);
        } else {
            return Response::json(['data' => $restaurant], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd('update restaurant');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $restaurant = Restaurant::findOrFail($id);
            $restaurant->delete();
            return Response::json([], 200);
        } catch (Exception $e) {
            return Response::json([], 404);
        }
    }

    public function followRestaurant(Request $request, $restaurantId)
    {
        $userId = 1;
        $restaurant = Restaurant::find($restaurantId);
        if ($restaurant == null) {
            return Response::json([], 404);
        }
        if ($request['task'] == 'follow') {
            $restaurant->users()->syncWithoutDetaching([$userId]);
            return Response::json([], 204);
        } else {
            $restaurant->users()->detach($userId);
            return Response::json([], 200);
        }
        
    }
}
