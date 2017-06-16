<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserReq;
use App\User;
use Exception;
use Response;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserReq $request) {
        try {
            $request['password'] = bcrypt($request['password']);
            $user = User::create($request->all());
            $response = $this->createItemUserResponse($user);
            return response($response)->setStatusCode(201);
        } catch (Exception $e) {
            $response = $this->createErrorResponse(['message' => 'Datos no correctos o hacen falta datos']);
            return response($response)->setStatusCode(400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $userId = $request->userId;
        $user = User::find($userId);
        if ($user == null) {
            dd('user not found');
        } else {
            $response = $this->createItemRestaurantUserResponse($user);
            return response($response)->setStatusCode(200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserReq $request)
    {
        $userId = $request->userId;
        $user = User::find($userId);
        $attributes = $request->all();
        $user->update($attributes);
        $response = $this->createItemUserResponse($user);
        return response($response)->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
