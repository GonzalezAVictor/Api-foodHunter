<?php

namespace App\Http\Middleware;

use Closure;
use League\Fractal\Manager;
use League\Fractal;
use JWTAuth;
use App\Transformer\ErrorTransformer;

class JWTmid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        try {
            $user = JWTAuth::parseToken()->authenticate();
            $request->userId = $user->id;
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            $response = $this->createErrorResponse(['message' => 'el token ha expirado']);
            return response($response)->setStatusCode(401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e2){
            $response = $this->createErrorResponse(['message' => 'el token no es valido']);
            return response($response)->setStatusCode(401);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e){
            $response = $this->createErrorResponse(['message' => 'el token no es valido']);
            return response($response)->setStatusCode(401);
        }
        return $next($request);
    }

    private function createErrorResponse($error)
    {
        $fractal = new Manager();
        $resource = new Fractal\Resource\Item($error, new ErrorTransformer());
        return $fractal->createData($resource)->toJson();
    }
}