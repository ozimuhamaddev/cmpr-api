<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\HelperService;
use App\Models\Banner;
use App\Models\AboutUs;
use App\Models\Projects;
use App\Models\Services;
use App\Models\News;
use App\Models\Contact;



class NewsController extends Controller
{
    public function index(Request $request)
    {
        $msg = "success get data banner";
        $getData = Banner::Home();
        return HelperService::_success($msg, $getData);
    }
}
