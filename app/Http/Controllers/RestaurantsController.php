<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function index() // 10 elementos por pagina
    {
        $response = $this->createCollectionRestaurantResponse(Restaurant::all());
        return response($response)->setStatusCode(200);

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $restaurant = Restaurant::create($request->all());
        $response = $this->createItemRestaurantResponse($restaurant);
        return response($response)->setStatusCode(201);
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
            $response =  $this->createErrorResponse(['message' => 'El restaurante con el id '.$id.' no existe']);
            return response($response)->setStatusCode(404);
        } else {
            $response = $this->createItemRestaurantResponse($restaurant);
            return response($response)->setStatusCode(200);
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
        $restaurant = Restaurant::find($id);
        if ($restaurant == null) {
            $response =  $this->createErrorResponse(['message' => 'El restaurante con el id '.$id.' no existe']);
            return response($response)->setStatusCode(404);
        } else {
            $attributes = $request->all();
            $restaurant->update($attributes);
            $response = $this->createItemRestaurantResponse($restaurant);
            return response($response)->setStatusCode(200);
        }
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
            $response = $this->createItemRestaurantResponse($restaurant);
            return response($response)->setStatusCode(200);
        } catch (Exception $e) {
            return response([])->setStatusCode(404);
        }
    }
}
