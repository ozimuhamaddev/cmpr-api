<?php

namespace App\Helpers;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Support\Facades\Auth;

class JwtHelper
{
    /**
     * Generate a JWT token for a given user.
     *
     * @param \App\Models\User $user
     * @return string
     */
    public static function generateToken($user)
    {
        return JWTAuth::fromUser($user);
    }

    /**
     * Invalidate the current token.
     *
     * @return void
     */
    public static function invalidateToken()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
    }

    /**
     * Refresh the current token.
     *
     * @return string
     */
    public static function refreshToken()
    {
        return JWTAuth::refresh(JWTAuth::getToken());
    }

    /**
     * Get the authenticated user from the token.
     *
     * @return \App\Models\User|null
     */
    public static function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return null;
            }
        } catch (TokenExpiredException $e) {
            return null;
        } catch (TokenInvalidException $e) {
            return null;
        } catch (JWTException $e) {
            return null;
        }

        return $user;
    }

    /**
     * Check if the token is valid.
     *
     * @return bool
     */
    public static function isValidToken()
    {
        try {
            JWTAuth::parseToken()->authenticate();
            return true;
        } catch (TokenExpiredException $e) {
            return false;
        } catch (TokenInvalidException $e) {
            return false;
        } catch (JWTException $e) {
            return false;
        }
    }
}
