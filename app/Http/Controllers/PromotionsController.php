<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Promotion;
use Exception;
use Response;

class PromotionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $promotion = new Promotion($request->all());
            $promotion->save();
            return Response::json([], 201);
        } catch (Exception $e) {
            return Response::json([$e], 400); //TODO: definir bien el codigo de respuesta
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
        dd('store');
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
        dd('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($restaurantId, $promoId)
    {
        // TODO: validate promotion belongs to restaurant
        try {
            $promotion = Promotion::findOrFail($promoId);
            $promotion->delete();
            return Response::json([], 200);
        } catch (Exception $e) {
            return Response::json([], 404);
        }
    }

    public function find($id)
    {
        $promotions = Promotion::where('restaurantId', $id)->get();
        return Response::json(['data' => $promotions], 200);
    }

    public function activePromotion(Request $request, $promoId)
    {
        $promotion = Promotion::find($promoId);
        if ($promotion == null) {
            return Response::json([], 404);
        }
        $promotion->active = true;
        $promotion->save();
        return Response::json([], 200);
    }

    public function huntPromotion(Request $request, $promoId)
    {
        $userId = 1;
        $promotion = Promotion::find($promoId);
        if ($promotion == null) {
            return Response::json([], 404);
        }
        $prey = DB::table('promotion_user')->where('promotion_id', $promotion->id)->where('user_id', $userId)->get();
        if (sizeof($prey) == 0) {
            $promotion->users()->syncWithoutDetaching([$userId]); // ASK: Seguro que no se puede hacer en una sola linea?
            $promotion->users()->updateExistingPivot($userId, ['active' => true]);
        } else {
            $promotion->users()->updateExistingPivot($userId, ['active' => true]);
        }
        return Response::json([], 200);
    }

    private function isPromotionActive($promotion)
    {
        if ($promotion->active) {
            return true;
        } else {
            return false;
        }
    }
}
