<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Exception;
use Response;
use JWTAuth;
use App\User;

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

}
