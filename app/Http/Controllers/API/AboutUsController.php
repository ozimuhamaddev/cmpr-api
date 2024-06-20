<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\HelperService;
use App\Models\AboutUs;

class AboutUsController extends Controller
{
    public function index(Request $request)
    {
        $msg = "success get data banner";
        $getData = AboutUs::Detail();
        return HelperService::success($msg, $getData);
    }
}
