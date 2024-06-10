<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\HelperService;
use App\Models\BannerHome;


class HomeController extends Controller
{
    public function BannerHome(Request $request)
    {
        $msg = "success get data banner";
        $getData = BannerHome::getList();
        return HelperService::_success($msg, $getData);
    }
}
