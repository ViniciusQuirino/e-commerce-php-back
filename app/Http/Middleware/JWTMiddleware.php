<?php
namespace App\Http\Middleware;

use Closure;
use App\Exceptions\AppError;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\{TokenExpiredException, TokenInvalidException, JWTException};

class JWTMiddleware {
    public function handle(Request $request, Closure $next) {
        try {
            
            JWTAuth::parseToken()->authenticate();
            return $next($request);
        } catch(JWTException $error) {
            if($error instanceof TokenInvalidException){
                throw new AppError("Token invalido", 498);
            }

            if($error instanceof TokenExpiredException){
                throw new AppError("Token expirado", 401);
            }

            throw new AppError($error->getMessage(), 500);
        }

    }
}