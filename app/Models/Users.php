<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Users extends Authenticatable implements JWTSubject
{

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;
    // Add this block to implement JWTSubject interface

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    // Assume this method fetches user details
    public static function Detail($username, $password)
    {
        return Self::select('id', 'name', 'email')
            ->where('name', $username)
            ->where('password', $password)
            ->first();
    }


    // Assume this method fetches user details
    public static function Updates($value, $id)
    {
        return Self::where('id', $id)->update($value);
    }

    // Assume this method fetches user details
    public static function UpdatesWithToken($value, $token)
    {
        return Self::where('token', $token)->update($value);
    }

    public static function CheckToken($token)
    {
        return Self::select('id', 'name', 'email')
            ->where('token', $token)
            ->first();
    }
}
