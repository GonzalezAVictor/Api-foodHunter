<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromotionReq;
use Illuminate\Http\Request;
use App\Promotion;
use App\Restaurant;
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
    public function store(PromotionReq $request)
    {
        $restaurantId = $this->getCurrentRestaurant()->id;
        $data = $request->all();
        $data['restaurant_id'] = $restaurantId;
        try {
            $promotion = Promotion::create($data);
            $response = $this->createItemPromotionResponse($promotion);
            return response($response)->setStatusCode(201);
        } catch (Exception $e) {
            $response = $this->createErrorResponse(['message' => 'error al crear una promocion']);
            return response($response)->setStatusCode(404);
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
    public function update(PromotionReq $request, $promotionId)
    {   
        try {
            $restaurantId = $this->getCurrentRestaurant()->id;
            $promotion = Promotion::findOrFail($promotionId);
            if($promotion->restaurant_id != $restaurantId) { return Response::json([], 403); }
            $attributes = $request->all();
            $promotion->update($attributes);
            $response = $this->createItemPromotionResponse($promotion);
            return response($response)->setStatusCode(200);
        } catch (Exception $e) {
            return Response::json([], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $promotionId)
    {
        try {
            $promotion = Promotion::findOrFail($promotionId);
            if($promotion->restaurant_id != $request->restaurantId) { return Response::json([], 403); }
            $promotion->delete();
            $response = $this->createItemPromotionResponse($promotion);
            return response($response)->setStatusCode(200);
        } catch (Exception $e) {
            return Response::json([], 404);
        }
    }

    public function find($id)
    {
        $promotions = Promotion::where('restaurant_id', $id)->get();
        $response = $this->createCollectionPromotionResponse($promotions);
        return response($response)->setStatusCode(200);
    }

    public function activePromotion(Request $request)
    {
        $restaurantId = $this->getCurrentRestaurant()->id;
        $promotion = Promotion::find($request['promotionId']);
        if ($promotion == null) {return Response::json([], 400);}
        if ($promotion->restaurant_id != $restaurantId) {return Response::json([], 400);}
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
