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
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

}
