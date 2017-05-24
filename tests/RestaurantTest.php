<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Restaurant;

class RestaurantTest extends TestCase
{

use DatabaseMigrations;

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

        $this->json('post', '/api/v1/restaurants', $data);

    	$this->assertResponseStatus(201);
    }

    public function test_createANewRestaurantWithWithRepeatedDataUsingPOST()
    {
        $restaurant = factory(Restaurant::class)->create();

        $data = [
            'name' => $restaurant->name,
            'openAt' => $restaurant->openAt,
            'closeAt' => $restaurant->closeAt,
            'ubication' => $restaurant->ubication,
            'slogan' => $restaurant->slogan,
            'description' => $restaurant->description,
            'password' => $restaurant->password,
            'email' => $restaurant->email
        ];

        $this->json('post', '/api/v1/restaurants', $data);

        $this->assertResponseStatus(400);
    }

    public function test_itGetAllRestaurants()
    {
    	$restaurant = factory(Restaurant::class, 3)->create();

        $this->json('get', '/api/v1/restaurants');

        $this->assertResponseStatus(200);
    }

    public function test_itGetOneSpecificRestaurantUsingGET()
    {
    	$restaurant = factory(Restaurant::class)->create();

        $this->json('get', 'api/v1/restaurants/'.$restaurant->id);

    	$this->assertResponseStatus(200);
    	$this->seeJsonEquals([
			'data' => [
    			'id' => $restaurant->id,
    			'name' => $restaurant->name,
    			'slogan' => $restaurant->slogan,
    			'description' => $restaurant->description,
    			'openAt' => $restaurant->openAt,
    			'closeAt' => $restaurant->closeAt,
                'ubication' => $restaurant->ubication
			]
		]);
    }

    public function test_itDeleteARestauratUsingDELETE()
    {
    	$restaurant = factory(Restaurant::class)->create();

    	$this->json('delete', '/api/v1/restaurants/'.$restaurant->id);

    	$this->assertResponseStatus(200);
    }

    public function test_itDeleteARestauratSendingWrogIdUsingDELETE()
    {
        $restaurant = factory(Restaurant::class)->create();

        $this->json('delete', '/api/v1/restaurants/'.$restaurant->id+1);

        $this->assertResponseStatus(404);
    }

    public function test_CreateARestaurantWithANameAtributeAlreadyExisteInDatabase()
    {
        $restaurant = factory(Restaurant::class)->create();

        $data = [
            'name' => $restaurant->name,
            'openAt' => '7:00',
            'closeAt' => '12:00',
            'ubication' => 'somewhere',
            'slogan' => 'th best',
            'description' => 'of the best',
            'password' => '1234',
            'email' => 'burguer@gmail.com'
        ];

        $this->json('post', '/api/v1/restaurants', $data);
        $this->assertResponseStatus(400);
    }

    public function test_getARestauratWithAnInvalidIndex()
    {
        $restaurant = factory(Restaurant::class)->create();

        $this->json('get', '/api/v1/restaurants/'.$restaurant->id+1);

        $this->assertResponseStatus(404);
    }

    public function test_updateDataFromASpecificRestaurantUsingPUT()
    {
        $restaurant = factory(Restaurant::class)->create();

        $data = [
            'name' => $restaurant->name,
            'openAt' => '7:00',
            'closeAt' => '12:00',
            'ubication' => 'somewhere',
            'slogan' => 'th best',
            'description' => 'of the best',
            'password' => '1234',
            'email' => 'burguer@gmail.com'
        ];
        
        $this->json('put', 'api/v1/restaurants/'.$restaurant->id, $data);

        $this->assertResponseStatus(200);
    }
}
