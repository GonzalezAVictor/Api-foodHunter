<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promotion;
use App\User;
use Exception;
use Response;
// Fractal
use League\Fractal\Manager;
use App\Transformer\ErrorTransformer;
use League\Fractal;

class FollowedPromotionsController extends Controller
{
    public function promotionsFollowedByUser($userId)
    {
      $user = User::find($userId);
      $user->promotions();
      return Response::json(['data' => $user->promotions], 200);
    }

    public function followPromotion(Request $request)
    {
        $fractal = new Manager();

        $userId = $request->userId;
        $promotion = Promotion::find($request['promotionId']);
        if ($promotion == null) {
            $request->errorMessage = 'la promocion con el id proporcionado no existe';
            $resource = new Fractal\Resource\Item('algo', new ErrorTransformer());
            $response = $fractal->createData($resource)->toJson();
            // return Response::json([], 404);
        }
        if ($this->isPromotionActive($promotion)) {
            $promotion->users()->syncWithoutDetaching([$userId]);
            return Response::json([], 200);
        } else {
            return Response::json(['error' => 'Promotions inactive can not be followed'], 422);
        }
    }

    public function unfollowPromotion($userId, $promotionId)
    {

        $promotion = Promotion::find($promotionId);
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
