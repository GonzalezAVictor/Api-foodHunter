<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;
use App\Restaurant;

class UserTest extends TestCase
{
use DatabaseMigrations;
use WithoutMiddleware;

    public function test_createAUserWithPOST()
    {
        $data = [
            'name' => 'pancho',
            'password' => '1234',
            'email' => 'burguer@gmail.com'
        ];

        $this->json('post', '/api/v1/users', $data);

        $this->assertResponseStatus(201);
    }

    public function test_thisModifyDataFromAnExistingUser()
    {  
        $user = factory(User::class)->create();

        $newData = [
            'userId' => $user->id,
            'name' => 'pancho',
            'email' => 'burguer@gmail.com'
        ];

        $this->json('put', '/api/v1/users', $newData);
        $this->assertResponseStatus(200);
        $this->seeJsonEquals([
            'data' => [
                'id' => $user->id,
                'name' => 'pancho',
                'email' => 'burguer@gmail.com'
            ]
        ]);
        
    }

    public function test_createNewUserWithRepeatedData()
    {
        $user = factory(User::class)->create();

        $data = [
            'name' => $user->name,
            'email' => 'burguer@gmail.com'
        ];

        $this->json('post', '/api/v1/restaurants', $data);
        $this->assertResponseStatus(400);
    }
}
