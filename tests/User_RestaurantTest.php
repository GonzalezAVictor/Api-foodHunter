<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Restaurant;
use App\User;

class User_RestaurantTest extends TestCase
{
	use WithoutMiddleware;
    use DatabaseMigrations;

    public function test_userFollowArestaurantWithPOST()
    {
    	$restaurant = factory(Restaurant::class)->create();
    	$user = factory(User::class)->create();

    	$data= [
    		'userId' => $user->id,
    		'restaurant_id' => $restaurant->id
    	];

    	$this->json('post', '/api/v1/users/followedRestaurants', $data);

    	$this->assertResponseStatus(200);
    }

    public function test_getRestaurantsFollowedByUser()
    {
        $user = factory(User::class)->create();

        $this->json('get', 'api/v1/users/'.$user->id.'/restaurants');

        $this->assertResponseStatus(200);
    }

    public function test_unfollowARestaurantByUserWithDELETE()
    {
        $restaurant = factory(Restaurant::class)->create();
        $user = factory(User::class)->create();

        $data= [
            'userId' => $user->id,
            'restaurant_id' => $restaurant->id
        ];

        $this->post('/api/v1/users/followedRestaurants', $data);

        $this->json('delete', '/api/v1/users/'.$user->id.'/followedRestaurants/'.$restaurant->id);

        $this->assertResponseStatus(200);
    }
}
