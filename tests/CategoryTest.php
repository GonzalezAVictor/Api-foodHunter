<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Category;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;
    
    public function test_createANewCategoryUsingPOST()
    {
    	$data = [
    		'name' => 'pasta',
    	];

        $this->json('post', '/api/v1/categories', $data);

    	$this->assertResponseStatus(201);
    }

    public function test_getAllCategoriesWithGET()
    {
    	$categories = factory(Category::class, 3)->create();

    	$this->json('get', 'api/v1/categories');

    	$this->assertResponseStatus(200);
    	
    }

    public function test_createANewCategoryWithRepeatedDataOnTheDBWithPOST()
    {
        $category = factory(Category::class)->create();

        $data=[
            'name' => $category->name
        ];
        
        $this->json('post', '/api/v1/categories', $data);
        $this->assertResponseStatus(400);
    }
}
