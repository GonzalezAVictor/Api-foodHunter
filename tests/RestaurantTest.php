<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Restaurant;
use App\Promotion;

class RestaurantTest extends TestCase
{

use DatabaseMigrations;
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_createANewRestaurantUsingPOST()
    {

    	$data = [
    		'name' => 'burguer',
    		'openAt' => '7:00',
    		'closeAt' => '12:00',
    		'ubication' => 'somewhere',
    		'slogan' => 'th best',
    		'description' => 'of the best',
    		'password' => '1234',
    		'email' => 'burguer@gmail.com'
    	];

        $response = $this->call('POST', '/restaurants', $data);

    	$this->assertEquals(201, $response->status());
    }

    public function test_itGetAllRestaurants()
    {

    	$restaurant = factory(Restaurant::class, 3)->create();

    	$response = $this->call('get', '/restaurants');

        $this->assertEquals(200, $response->status());
    }

    public function test_itGetOneSpecificRestaurantUsingGET()
    {
    	$restaurant = factory(Restaurant::class, 3)->create();

    	$response = $this->call('get', '/restaurants/1');

    	$this->assertEquals(200, $response->status());
    	$response->assertExactJson([
			'data' => [
			'id' => $restaurant->id,
			'name' => $restaurant->name,
			'slogan' => $restaurant->slogan,
			'description' => $restaurant->description,
			'openAt' => $restaurant->openAt,
			'closeAt' => $restaurant->closeAt
			]
		]);
    }

    public function test_itDeleteARestauratUsingDELETE()
    {
    	$restaurant = factory(Restaurant::class)->create();

    	$response = $this->call('delete', '/restaurants/1');

    	$this->assertEquals(200, $response->status());
    }
}
