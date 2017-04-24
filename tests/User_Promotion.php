<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Promotion;

class User_Promotion extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_userFollowAPromotionUsingPOST()
    {
        $user = factory(User::class)->create();
        $promotion = factory(Promotion::class)->create();

        $data =[
    		'task' => 'follow'
    	];

        $response = $this->call('post', '/promotions/1/ambush');

        $this->assertEquals(200, $response->status());
    }

    public function test_userUnfollowAPromotionUsingPOST()
    {
        $user = factory(User::class)->create();
        $promotion = factory(Promotion::class)->create();

        $data =[
    		'task' => 'unfollow'
    	];

        $response = $this->call('post', '/promotions/1/ambush');

        $this->assertEquals(200, $response->status());
    }

    public function test_userActiveAPromotionUsingPOST()
    {
        $user = factory(User::class)->create();
        $promotion = factory(Promotion::class)->create();

        $response = $this->call('post', '/promotions/1/hunt');

        $this->assertEquals(200, $response->status());
    }
}
