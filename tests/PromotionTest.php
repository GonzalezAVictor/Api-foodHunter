<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Promotion;

class PromotionTest extends TestCase
{
    use DatabaseMigrations;

    public function test_createANewPromotionUsingPOST()
    {
    	$data = [
    		'name' => 'burguer',
    		'startAt' => '7:00',
    		'endAt' => '12:00',
    		'promotion_type' => 'flash',
    		'details' => 'algunos detalles'
    	];

        $this->json('post', 'api/v1/restaurants/1/promotions', $data);

    	$this->assertResponseStatus(201);
    }

    public function test_itGetAllPromotionsFromARestaurantWithGet()
    {
    	$promotion = factory(Promotion::class)->create();

        $this->json('get', '/api/v1/restaurants/'.$promotion->restaurant_id.'/promotions');

        $this->assertResponseStatus(200);
    }

    public function test_activeAPromotionBeingTheRestaurantOwner()
    {
    	$promotion = factory(Promotion::class)->create();

    	$data = [
    		'promotion_id' => $promotion->id,
    		'restaurant_id' => $promotion->restaurant_id
    	];
    	
    	$this->json('post', '/api/v1/promotions/promotionsActive', $data);
    	$this->assertResponseStatus(200);
    }

    public function test_activeAPromotionWithoutBeingTheRestaurantOwner()
    {
    	$promotion = factory(Promotion::class)->create();

    	$data = [
    		'promotion_id' => $promotion->id,
    		'restaurant_id' => $promotion->restaurant_id+1
    	];
    	
    	$this->json('post', '/api/v1/promotions/promotionsActive', $data);
    	$this->assertResponseStatus(400);
    }

    public function test_itDeleteAPromotionsBeingTheRestaurantOwnerUsingDELETE()
    {
    	$promotion = factory(Promotion::class)->create();

    	$this->json('delete', '/api/v1/restaurants/'.$promotion->restaurant_id.'/promotions/'.$promotion->id);

    	$this->assertResponseStatus(200);
    }

    public function test_itDeleteAPromotionsWhitoutBeingTheRestaurantOwnerUsingDELETE()
    {
    	$promotion = factory(Promotion::class)->create();

    	$this->json('delete', '/api/v1/restaurants/4/promotions/'.$promotion->id);

    	$this->assertResponseStatus(403);
    }

    public function test_updatePrmotionBeingTheOwnerDataWithPUT()
    {
    	$promotion = factory(Promotion::class)->create();

    	$data = [
    		'name' => 'burguer',
    		'startAt' => '7:00',
    		'endAt' => '12:00',
    		'promotion_type' => 'flash',
    		'details' => 'algunos detalles'
    	];
    	
    	$this->json('put', 'api/v1/restaurants/'.$promotion->restaurant_id.'/promotions/'.$promotion->id, $data);

    	$this->assertResponseStatus(200);
    }

    public function test_updatePrmotionWithOutBeingTheOwnerDataWithPUT()
    {
    	$promotion = factory(Promotion::class)->create();

    	$data = [
    		'name' => 'burguer',
    		'startAt' => '7:00',
    		'endAt' => '12:00',
    		'promotion_type' => 'flash',
    		'details' => 'algunos detalles'
    	];
    	
    	$this->json('put', 'api/v1/restaurants/0/promotions/'.$promotion->id, $data);

    	$this->assertResponseStatus(403);
    }
















}
