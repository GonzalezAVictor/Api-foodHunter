<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;
use App\Restaurant;

class UserTest extends TestCase
{
use DatabaseMigrations;

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

    // public function test_thisModifyDataFromAnExistingUser()
    // {  
    //     // hacer que el usuario tengo un token
    //     $data = [
    //         'name' => 'pancho',
    //         'email' => 'burguer@gmail.com'
    //     ];

    //     $response = $this->post('/api/v1/sessions', $data);

    //     echo "-----------------";
    //     print($response->all);

    //     $user = factory(User::class)->create();

    //     $newData = [
    //         'name' => 'pancho',
    //         'email' => 'burguer@gmail.com'
    //     ];

    //     $this->json('put', '/api/v1/users', $newData);
    //     $this->assertResponseStatus(201);
    //     $this->seeJsonEquals([
    //         'data' => [
    //             'id' => $user->id,
    //             'name' => $user->name,
    //             'email' => $user->email
    //         ]
    //     ]);
        
    // }
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
