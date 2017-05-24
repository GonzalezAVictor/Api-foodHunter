<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Promotion;

class User_PromotionTest extends TestCase
{
	use DatabaseMigrations;
	use WithoutMiddleware;

	public function test_followAPromotionNotActiveUsingPOST()
	{
		$promotion = factory(Promotion::class)->create();
		$user = factory(User::class)->create();

		$data= [
			'userId' => $user->id,
			'promotionId' => $promotion->id
		];

		$this->json('post', '/api/v1/users/followedPromotions', $data);

		$this->assertResponseStatus(403);
	}
    
    public function test_followAPromotionThatIsActiveUsingPOST()
	{
		$promotion = factory(Promotion::class)->create();
		$promotion->active = true;
		$promotion->save();
		$user = factory(User::class)->create();

		$data= [
			'userId' => $user->id,
			'promotionId' => $promotion->id
		];

		$this->json('post', '/api/v1/users/followedPromotions', $data);

		$this->assertResponseStatus(200);
	}

	public function test_unfollowAPUsingPOST()
	{
		$promotion = factory(Promotion::class)->create();
		$user = factory(User::class)->create();

		$this->json('delete', '/api/v1/users/'.$user->id.'/followedPromotions/'.$promotion->id);

		$this->assertResponseStatus(200);
	}
    
}
