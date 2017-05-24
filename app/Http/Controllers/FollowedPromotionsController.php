<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promotion;
use Exception;
use Response;

class FollowedPromotionsController extends Controller
{
    public function followPromotion(Request $request)
    {
        $userId = $request->userId;
        $promotion = Promotion::find($request['promotionId']);
        if ($promotion == null) {
            $response = $this->createErrorResponse(['message' => 'La promocion '.$request['name'].' y id: '.$request['promotionId'].' no eixiste']);
            return response($response)->setStatusCode(404);
        }
        if ($this->isPromotionActive($promotion)) {
            $promotion->users()->syncWithoutDetaching([$userId]);
            return Response::json([], 200);
        } else {
            $response = $this->createErrorResponse(['message' => 'La promocion '.$request['name'].' y id: '.$request['promotionId'].' no esta activa']);
            return response($response)->setStatusCode(403);
        }
    }

    public function unfollowPromotion($userId, $promoId)
    {
        $promotion = Promotion::find($promoId);
        if ($promotion == null) {
            return Response::json([], 404);
        }
        $promotion->users()->detach($userId);
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
