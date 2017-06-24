<?php
namespace App\Transformer;

use League\Fractal;
use App\User;

class RestaurantUserTransformer extends Fractal\TransformerAbstract
{
  public function transform(User $user)
  {

    $restaurantsId = [];
    $restaurants = $user->restaurants()->get();
    foreach ($restaurants as $restaurant) {
      $restaurantsId[] = $restaurant->id;
    }

    $promotionsId = [];
    $promotions = $user->promotions()->get();
    foreach ($promotions as $promotion) {
      $promotionsId[] = $promotion->id;
    }

      return [
          'id' => $user->id,
          'name' => $user->name,
          'email' => $user->email,
          // 'followedRestaurants' => $user->restaurants()->get(),
          'followedRestaurants' => $restaurantsId,
          // 'followedPromotions' => $user->promotions()->get()
          'followedPromotions' => $promotionsId
      ];
  }
}