<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            return match ($e) {
                $e instanceof TokenInvalidException => new Response([
                    'data' => 'Token is invalid',
                ]),
                $e instanceof TokenExpiredException => new Response([
                    'data' => 'Token is expired',
                ]),
                $e => new Response([
                    'data' => 'Token was not provided or found',
                ]),
            };
        }

        return $next($request);
    }
}
