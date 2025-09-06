<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckJWTFromSession
{
    public function handle($request, Closure $next)
    {
        if ($token = session('jwt_token')) {
            JWTAuth::setToken($token);
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }

        return $next($request);
    }
}
