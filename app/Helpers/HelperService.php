<?php

namespace App\Helpers;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Users;

class HelperService
{
    public static function success($msg, $data)
    {
        return [
            'response_code' => 200,
            'message' => $msg,
            'data' => $data
        ];
    }

    public static function badRequest($msg, $data)
    {
        return [
            'response_code' => 400,
            'message' => $msg,
            'data' => $data,
            'error' => 1
        ];
    }

    public static function encrypt($data)
    {
        $method = 'AES-256-CBC';
        $key = substr(hash('sha256', env('MYSECRET'), true), 0, 32); // Generate a 256-bit key from the provided key

        // Derive a 16-byte initialization vector (IV) from the data
        $iv = substr(hash('sha256', $data . env('MYSECRET'), true), 0, 16);

        $encrypted = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv);
        $result = base64_encode($iv . $encrypted); // Concatenate IV and encrypted data, then encode in base64

        // Make it URL safe
        $result = str_replace(['+', '/', '='], ['-', '_', ''], $result);

        return $result;
    }


    public static function decrypt($data)
    {
        $method = 'AES-256-CBC';
        $key = substr(hash('sha256', env('MYSECRET'), true), 0, 32); // Generate a 256-bit key from the provided key
        $data = str_replace(['-', '_'], ['+', '/'], $data); // Revert URL safe encoding
        $data = base64_decode($data); // Decode the base64 encoded data
        $iv = substr($data, 0, 16); // Extract the IV from the data
        $encrypted = substr($data, 16); // Extract the encrypted data
        return openssl_decrypt($encrypted, $method, $key, OPENSSL_RAW_DATA, $iv);
    }

    public static function isTokenValid($token)
    {
        try {
            // Attempt to decode and verify the token
            JWTAuth::setToken($token)->checkOrFail();

            $check =  Users::CheckToken($token);
            if (!$check) {
                return false;
            }
            return true;
        } catch (TokenExpiredException $e) {
            // Token expired
            return false;
        } catch (TokenInvalidException $e) {
            // Token invalid
            return false;
        } catch (JWTException $e) {
            // General JWT exception
            return false;
        }
    }
}
