<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promotion;
use Exception;
use Response;

class FollowedPromotionsController extends Controller
{
    public function followPromotion(Request $request)
    { // /promotions/abmush { promotion_id}
        $userId = 1;    // TODO: change this
        $promotion = Promotion::find($request['promotion_id']);
        if ($promotion == null) {
            return Response::json([], 404);
        }
        if ($this->isPromotionActive($promotion)) {
            $promotion->users()->syncWithoutDetaching([$userId]);
            return Response::json([], 200);
        } else {
            return Response::json(['error' => 'Promotions inactive can not be followed'], 422);
        }
    }

    public function unfollowPromotion(Request $request)
    {
    	$userId = 1;    // TODO: change this
        $promotion = Promotion::find($request['promotion_id']);
        if ($promotion == null) {
            return Response::json([], 404);
        }
        if ($this->isPromotionActive($promotion)) {
            $promotion->users()->detach($userId);
            return Response::json([], 200);
        } else {
            return Response::json(['error' => 'Promotions inactive can not be followed'], 422);
        }
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
