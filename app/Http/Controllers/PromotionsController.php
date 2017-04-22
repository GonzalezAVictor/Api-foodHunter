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

    public function followPromotion(Request $request)
    { // /promotions/abmush { promotion_id}
        $promotion = Promotion::find($request['promotionId']);
        if ($promotion == null) {
            return Response::json([], 404);
        }
        if ($this->isPromotionActive($promotion)) {
            if ($request['task'] == 'follow') {
                $promotion->users()->syncWithoutDetaching([1]); // TODO: change syncWithoutDetaching
                return Response::json([], 200);
            } else {
                $promotion->users()->detach(1); // TODO: change detach for userId
                return Response::json([], 200);
            }
        } else {
            return Response::json(['error' => 'Promotions inactive can not be followed'], 422);
        }
    }

    public function activePromotion($promoId)
    {
        $promotion = Promotion::find($promoId);
        if ($promotion == null) {
            return Response::json([], 404);
        }
        $promotion->active = true;
        $promotion->save();
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
