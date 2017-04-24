<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Restaurant;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_itCreatANreUserUsingPOST()
    {
    	$response = $this->call('post', '/categories', [
    		'name' => 'victor',
    		'email' => 'victor@gmail.com',
    		'password' => '1234',
    		]);

    	$this->assertEquals(201, $response->status());
    }

    public function test_userAmbushARestaurant()
    {
    	$data =[
    		'task' => 'follow'
    	];

    	$user = factory(User::class)->create();
    	$restaurant = factory(Restaurant::class)->create();

    	$response = $this->call('post', '/restaurants/1/ambush');
    	$this->assertEquals(200, $response->status());
    }

    public function test_userUnfollowARestaurant()
    {
    	$data =[
    		'task' => 'unfollow'
    	];

    	$user = factory(User::class)->create();
    	$restaurant = factory(Restaurant::class)->create();

    	$response = $this->call('post', '/restaurants/1/ambush');
    	$this->assertEquals(200, $response->status());
    }
}
