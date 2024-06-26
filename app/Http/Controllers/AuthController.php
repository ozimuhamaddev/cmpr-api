<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Helpers\JwtHelper;
use App\Helpers\HelperService;
use Validator;
use JWTAuth;

class AuthController extends Controller
{
    /**
     * Handle user login and generate a JWT.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function showLoginForm()
    {
        return view('auth.login'); // Ensure you have this view created
    }

    public function login(Request $request)
    {
        $username = $request->input('cek_username');
        $password = HelperService::encrypt($request->input('cek_password'));

        // Assuming Users::Detail fetches the user by username and password
        $getData = Users::Detail($username, $password);

        if ($getData) {
            // Ensure $getData is an instance of User and implements JWTSubject
            if (!$getData instanceof Users) {
                return response()->json(['error' => 'User data not valid'], 401);
            }

            $token = JwtHelper::generateToken($getData);
            // Get token TTL (Time to Live) from the config

            $value = [
                'token' => $token
            ];
            Users::Updates($value, $getData->id);

            return HelperService::success("success login", [
                'token' => $token
            ]);
        }
        return HelperService::badRequest("Unauthorized", []);
    }


    public function checkToken(Request $request)
    {
        $token = $request->input('token'); // Ambil token dari request

        if (!$token) {
            // Token tidak ada
            return HelperService::badRequest("Token not provided", []);
        }

        // Panggil fungsi untuk memeriksa token
        if (HelperService::isTokenValid($token)) {
            return HelperService::success("Token is valid", []);
        } else {
            // Token tidak valid
            return HelperService::badRequest("Token is invalid or expired", []);
        }
    }

    public function logout(Request $request)
    {
        $value = [
            'token' => ""
        ];

        Users::UpdatesWithToken($value, $request->input('token'));
        return HelperService::success("logout success", []);
    }
}
