<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Restaurant;
use App\Promotion;

class Restaurant_Promotion extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_restaurantActiveAPromotionUsingPOST()
    {
    	$restaurant = factory(Restaurant::class)->create();
    	$promotions = factory(Promotion::class)->create();

    	$response = $this->call('post', 'promotions/1/active');

    	$this->assertEquals(200, $response->status());
    }

    public function test_restaurantCreateAPromotionUsingPOST()
    {
    	$restaurant = factory(Restaurant::class)->create();
    	
    	$data = [
    		'name' => 'promo1',
    		'details' => 'details',
    		'startAt' => '7:00',
    		'endAt' => '10:00',
    		'promotion_type' => 'premium',
    		'amount_available' => '10'
    	];

    	$response = $this->call('post', '/restaurants/1/promotions', $data);

    	$this->assertEquals(200, $response->status());
    }
}
