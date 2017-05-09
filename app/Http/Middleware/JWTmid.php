<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

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
        $token = $request->header('token');
        $user = JWTAuth::toUser($token);
        $request->userId = $user->id;
        return $next($request);
    }
}