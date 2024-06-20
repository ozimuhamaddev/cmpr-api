<?php

namespace App\Helpers;

class HelperService
{
    public function success($msg, $data)
    {
        return [
            'response_code' => 200,
            'message' => $msg,
            'data' => $data
        ];
    }

    public function badRequest($msg, $data)
    {
        return [
            'response_code' => 400,
            'message' => $msg,
            'data' => $data,
            'error' => 1
        ];
    }

    public function encrypt($data)
    {
        $method = 'AES-256-CBC';
        $key = substr(hash('sha256', env('MYSECRET'), true), 0, 32); // Generate a 256-bit key from the provided key
        $iv = openssl_random_pseudo_bytes(16); // Generate a 16-byte initialization vector (IV)
        $encrypted = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv);
        $result = base64_encode($iv . $encrypted); // Concatenate IV and encrypted data, then encode in base64
        $result = str_replace(['+', '/', '='], ['-', '_', ''], $result); // Make it URL safe
        return $result;
    }


    public function decrypt($data)
    {
        $method = 'AES-256-CBC';
        $key = substr(hash('sha256', env('MYSECRET'), true), 0, 32); // Generate a 256-bit key from the provided key
        $data = str_replace(['-', '_'], ['+', '/'], $data); // Revert URL safe encoding
        $data = base64_decode($data); // Decode the base64 encoded data
        $iv = substr($data, 0, 16); // Extract the IV from the data
        $encrypted = substr($data, 16); // Extract the encrypted data
        return openssl_decrypt($encrypted, $method, $key, OPENSSL_RAW_DATA, $iv);
    }
}
