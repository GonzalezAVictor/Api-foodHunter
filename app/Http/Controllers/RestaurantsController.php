<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Restaurant;
use Exception;
use Response;
// Fractal
use League\Fractal\Manager;
use App\Transformer\RestauranTrasformer;
use App\Transformer\ErrorTransformer;
use League\Fractal;

class RestaurantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // 10 elementos por pagina
    {
        $fractal = new Manager();
        $resource = new Fractal\Resource\Collection(Restaurant::all(), new RestauranTrasformer());
        $response = $fractal->createData($resource)->toJson();
        return response($response)->setStatusCode(200);

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $fractal = new Manager();
        $restaurant = Restaurant::create($request->all());
        $resource = new Fractal\Resource\Item($restaurant, new RestauranTrasformer());
        $response = $fractal->createData($resource)->toJson();
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
        $fractal = new Manager();
        $restaurant = Restaurant::find($id);
        if ($restaurant == null) {
            $request = new Request();
            $request->message = 'el restaurant con el id '.$id.' no existe';
            $resource = new Fractal\Resource\Item($request, new ErrorTransformer());
            return response($fractal->createData($resource)->toJson())->setStatusCode(404);
        } else {
            $resource = new Fractal\Resource\Item($restaurant, new RestauranTrasformer());
            return response($fractal->createData($resource)->toJson())->setStatusCode(200);
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
}
