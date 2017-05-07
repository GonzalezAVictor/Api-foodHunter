<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
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
        // $restaurants = Restaurant::all();
        // return Response::json(['data' => $restaurants]);

        $page = Input::get('page');
        $startIndex = 3 * ($page -1);
        $restaurants = DB::table('restaurants')->skip($startIndex)->limit(1)->get();
        return Response::json(['data' => $restaurants], 200);

        $restaurants = Restaurant::all();
        $startIndex = 3 * ($page -1);

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $restaurant = Restaurant::create($request->all());
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
}
