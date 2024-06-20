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
use App\Models\Others;

class HomeController extends Controller
{
    public function BannerHome(Request $request)
    {
        $msg = "success get data banner";
        $getData = Banner::Home();
        return HelperService::success($msg, $getData);
    }

    public function AboutUsHome(Request $request)
    {
        $msg = "success get data about";
        $getData = AboutUs::Home();
        return HelperService::success($msg, $getData);
    }

    public function ProjectsHome(Request $request)
    {
        $msg = "success get data projects";
        $getData = Projects::Home();
        $getDataArray = [];
        foreach ($getData as $values) {
            $getDataArray[] = [
                "id" => HelperService::encrypt($values['project_id']),
                "title" => $values['title'],
                "description" => $values['description'],
                "short_description" => $values['short_description'],
                "image_ori" => $values['image_ori'],
                "image" => $values['image'],
                "icon_image" => $values['icon_image'],
                "icon_image_ori" => $values['icon_image_ori'],
                "proj_category_name" => $values['proj_category_name'],
                "created_at" => $values['created_at'],
                "created_by" => $values['created_by'],
                "updated_at" => $values['updated_at'],
                "updated_by" => $values['updated_by']
            ];
        }
        return HelperService::success($msg, $getDataArray);
    }

    public function ServicesHome(Request $request)
    {
        $msg = "success get data services";
        $getData = Services::Home();
        $getDataArray = [];
        foreach ($getData as $values) {
            $getDataArray[] = [
                "id" => HelperService::encrypt($values['sevices_id']),
                "title" => $values['title'],
                "description" => $values['description'],
                "short_description" => $values['short_description'],
                "image_ori" => $values['image_ori'],
                "image" => $values['image'],
                "icon_image" => $values['icon_image'],
                "icon_image_ori" => $values['icon_image_ori'],
                "created_at" => $values['created_at'],
                "created_by" => $values['created_by'],
                "updated_at" => $values['updated_at'],
                "updated_by" => $values['updated_by']
            ];
        }
        return HelperService::success($msg, $getDataArray);
    }

    public function NewsHome(Request $request)
    {
        $msg = "success get data news";
        $getData = News::Home();
        $getDataArray = [];
        foreach ($getData as $values) {
            $getDataArray[] = [
                "id" => HelperService::encrypt($values['news_id']),
                "title" => $values['title'],
                "description" => $values['description'],
                "short_description" => $values['short_description'],
                "image_ori" => $values['image_ori'],
                "image" => $values['image'],
                "tag" => $values['tag'],
                "category_name" => $values['category_name'],
                "created_at" => $values['created_at'],
                "created_by" => $values['created_by'],
                "updated_at" => $values['updated_at'],
                "updated_by" => $values['updated_by']
            ];
        }
        return HelperService::success($msg, $getDataArray);
    }

    public function ContactHome(Request $request)
    {
        $msg = "success get data contact";
        $getData = Contact::Home();
        return HelperService::success($msg, $getData);
    }

    public function OthersHome(Request $request)
    {
        $msg = "success get data about";
        $getData = Others::Home();
        return HelperService::success($msg, $getData);
    }


    public function ProjectsCategory(Request $request)
    {
        $msg = "success get data project category";
        $getData = Projects::ProjectsCategory();
        return HelperService::success($msg, $getData);
    }
}
