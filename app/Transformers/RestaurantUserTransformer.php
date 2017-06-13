<?php
namespace App\Transformer;

use League\Fractal;
use App\User;

class RestaurantUserTransformer extends Fractal\TransformerAbstract
{
  public function transform(User $user)
  {
      return [
          'id' => $user->id,
          'name' => $user->name,
          'email' => $user->email,
          'followedRestaurants' => [
            $user->restaurants()->get()
          ],
          'followedPromotions' => [
            $user->promotions()->get()
          ]
      ];
  }
}