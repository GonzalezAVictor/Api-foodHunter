<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTFactory;
use Exception;
use Response;
use JWTAuth;
use App\User;
use App\Restaurant;

class SessionsController extends Controller
{

    public function login(Request $request)
    {
        $data = $request->all();
        try {
            if (! $token = JWTAuth::attempt(['email' => $request['email'], 'password' => $request['password']]))  {
                $response = $this->createErrorResponse(['message' => 'invalid credentials']);
                return response($response)->setStatusCode(400);
            }
        } catch (JWTException $e) {
            $response = $this->createErrorResponse(['message' => 'No se ha podico crear el token']);
            response($response)->setStatusCode(400);
        }
        return response()->json(compact('token'));
    }

    public function loginRestaurants(Request $request)
    {
        $result = Restaurant::where('email', $request['email'])->get();
        $restaurant = $result->all()[0];
        if ($request['password'] == $restaurant->password) {
            $payload = JWTFactory::sub(4)->aud('credentials')->credentials([
                'email' => $restaurant->email,
                'password' => $restaurant->password,
                'id' => $restaurant->id,
                ])->make();
            $token = JWTAuth::encode($payload);
        } else {
            dd('crear un error para cuando las credenciales no son validas');
        }
        dd($token);
    }

}
