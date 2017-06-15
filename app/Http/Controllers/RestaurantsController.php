<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RestaurantReq;
use App\Http\Requests\restaurantController;
use App\Restaurant;
use App\Category;
use Exception;
use Response;
use Illuminate\Support\Facades\Input;

class RestaurantsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Responsep
     */
    public function index()
    {
        $start = (Input::get('page') - 1) * 3;
        $collection = Restaurant::skip($start)->take(3)->get();
        $response = $this->createCollectionRestaurantResponse($collection);
        return response($response)->setStatusCode(200);

    }

    public function create()
    {
        //
    }

    public function store(RestaurantReq $request)
    {
        try {
            $restaurant = Restaurant::create($request->all());
            $response = $this->createItemRestaurantResponse($restaurant);
            return response($response)->setStatusCode(201);
        } catch (\Illuminate\Database\QueryException $e) {
            $response = $this->createErrorResponse(['message' => 'alguno de los atributos del restaurant ya existe en la base de datos']);
            return response($response)->setStatusCode(400);
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
    public function update(RestaurantReq $request, $id)
    {
        try {
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
        } catch (\Illuminate\Database\QueryException $e) {
            $response = $this->createErrorResponse(['message' => 'Datos duplicados']);
            return response($response)->setStatusCode(400);
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
            $response = $this->createErrorResponse(['message' => 'el restaurante con id '.$id.' no existe']);
            return response($response)->setStatusCode(404);
        }
    }

    public function getRandomRestaurant(Request $request)
    {
        $data = $request->all();
        $randIndexCategory = array_rand($data['categoriesId']);
        $randCategoryId = $data['categoriesId'][$randIndexCategory];
        $randCategory = Category::find($randCategoryId);
        $restaurants = $randCategory->restaurants()->get();
        $randIndexRestaurant = array_rand($restaurants->toArray());
        $restaurant = $restaurants[$randIndexRestaurant];
        $response = $this->createItemRestaurantResponse($restaurant);
        return response($response)->setStatusCode(200);
    }

    public function setCategoriesToRestaurant(Request $request)
    {
        $restaurant = Restaurant::find($request['restaurantId']);
        if ($restaurant == null) {
            $response =  $this->createErrorResponse(['message' => 'El restaurante con el id '.$request['restaurantId'].' no existe']);
            return response($response)->setStatusCode(404);
        }
        $restaurant->categories()->syncWithoutDetaching($request['categoriesId']);
        return Response::json([], 200);
    }
}
