<?php

namespace App\Http\Middleware;

use App\Core\Helpers\Response;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {

            JWTAuth::parseToken()->authenticate();

        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException)
                return Response::error(401, 'Invalid token');
            else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
                return Response::error(401, 'Token expired');
            else
                return Response::error(401, 'Token not found');
        }

        return $next($request);
    }
}
