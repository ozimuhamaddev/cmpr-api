<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use App\Models\Users;

class CheckJWT
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        // Jika tidak ada token dalam header Authorization, coba ambil dari body JSON
        if (!$token && $request->has('token')) {
            $token = $request->input('token');
        }

        if (!$token) {
            return response()->json(['error' => 'Authorization Token not found'], 401);
        }

        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'Token is expired'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'Token is invalid'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to parse token'], 400);
        } catch (Exception $e) {
            return response()->json(['error' => 'Authorization Token not found'], 401);
        }

        $check =  Users::CheckToken($token);
        if (!$check) {
            return response()->json(['error' => 'Token is invalid'], 401);
        }

        return $next($request);
    }
}
