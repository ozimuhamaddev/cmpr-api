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



class HomeController extends Controller
{
    public function BannerHome(Request $request)
    {
        $msg = "success get data banner";
        $getData = Banner::Home();
        return HelperService::_success($msg, $getData);
    }

    public function AboutUsHome(Request $request)
    {
        $msg = "success get data about";
        $getData = AboutUs::Home();
        return HelperService::_success($msg, $getData);
    }

    public function ProjectsHome(Request $request)
    {
        $msg = "success get data projects";
        $getData = Projects::Home();
        return HelperService::_success($msg, $getData);
    }

    public function ServicesHome(Request $request)
    {
        $msg = "success get data services";
        $getData = Services::Home();
        return HelperService::_success($msg, $getData);
    }

    public function NewsHome(Request $request)
    {
        $msg = "success get data news";
        $getData = News::Home();
        return HelperService::_success($msg, $getData);
    }

    public function ContactHome(Request $request)
    {
        $msg = "success get data contact";
        $getData = Contact::Home();
        return HelperService::_success($msg, $getData);
    }
}
