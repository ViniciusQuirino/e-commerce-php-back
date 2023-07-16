<?php

namespace App\Http\Middleware;

use Closure;
use App\Exceptions\AppError;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class IsAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        $jwtToken = new \Tymon\JWTAuth\Token($token);

        $payload = JWTAuth::decode($jwtToken);

        $type = $payload->get('type');

        if ($type === 'ADMINISTRADOR') {
            return $next($request);
        } else {
            throw new AppError('Essa rota é permitida apenas para administradores.',403);
        }
    }
}
