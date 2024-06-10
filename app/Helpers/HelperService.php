<?php

namespace App\Helpers;

class HelperService
{
    public static function _success($msg, $data)
    {
        $result = array(
            'response_code' => 200,
            'message' => $msg,
            'data' => $data,

        );
        return $result;
    }

    public static function _badRequest($msg, $data)
    {
        $result = array(
            'response_code' => 400,
            'message' => $msg,
            'data' => $data,
            'error' => 1
        );

        return $result;
    }
}
