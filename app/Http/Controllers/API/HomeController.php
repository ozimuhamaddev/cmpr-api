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
use App\Models\Menu;
use App\Models\Icon;
use App\Models\Clients;
use App\Models\NumberClient;
use App\Models\WeDo;

class HomeController extends Controller
{
    public function BannerHome(Request $request)
    {
        $msg = "success get data banner";
        $getData = Banner::Home();
        $getData->orderBy('banner.sort', 'DESC');
        $getData->orderBy('created_at', 'DESC');
        $getData->orderBy('updated_at', 'ASC');
        $getData = $getData->get();
        $getDataArray = [];
        foreach ($getData as $values) {
            $getDataArray[] = [
                'id' => HelperService::encrypt($values->banner_id),
                'title' => $values->title,
                'sub_title' => $values->sub_title,
                'image_ori' => $values->image_ori,
                'image' => $values->image,
                'created_at' => $values->created_at,
                'created_by' => $values->created_by,
                'updated_at' => $values->updated_at,
                'updated_by' => $values->updated_by
            ];
        }

        return HelperService::success($msg, $getDataArray);
    }

    public function AboutUsHome(Request $request)
    {
        $msg = "success get data about";
        $getData = AboutUs::Detail();
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
                "id" => HelperService::encrypt($values['services_id']),
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
        $getData = Contact::Detail();
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
        $data = Projects::ProjectsCategory();
        $getDataArray = [];
        foreach ($data as $values) {
            $getDataArray[] = [
                "id" => HelperService::encrypt($values->proj_category_id),
                "proj_category_name" => $values->proj_category_name,
            ];
        }

        $msg = "success get data project category";
        return HelperService::success($msg, $getDataArray);
    }

    public function Menu(Request $request)
    {
        $msg = "success get data menu";
        $getData = Menu::GetMenu()->get();
        return HelperService::success($msg, $getData);
    }

    public function Icon(Request $request)
    {
        $data = Icon::getData();
        $getDataArray = [];
        foreach ($data as $values) {
            $getDataArray[] = [
                "id" => HelperService::encrypt($values->icon_id),
                "icon_image" => $values->icon_image,
                "icon_image_ori" => $values->icon_image_ori,
            ];
        }

        $msg = "success get data project category";
        return HelperService::success($msg, $getDataArray);
    }




    public function ClientsHome(Request $request)
    {
        $msg = "success get data Clients";
        $getData = Clients::Home();
        $getData->orderBy('clients.sort', 'DESC');
        $getData->orderBy('created_at', 'DESC');
        $getData->orderBy('updated_at', 'ASC');
        $getData = $getData->get();
        $getDataArray = [];
        foreach ($getData as $values) {
            $getDataArray[] = [
                "id" => HelperService::encrypt($values['clients_id']),
                "title" => $values['title'],
                "short_description" => $values['short_description'],
                "image_ori" => $values['image_ori'],
                "image" => $values['image'],
            ];
        }
        return HelperService::success($msg, $getDataArray);
    }

    public function NumberClientHome(Request $request)
    {
        $msg = "success get data NumberClient";
        $getData = NumberClient::Home();
        $getData->orderBy('number_client.sort', 'DESC');
        $getData->orderBy('created_at', 'DESC');
        $getData->orderBy('updated_at', 'ASC');
        $getData = $getData->get();
        $getDataArray = [];
        foreach ($getData as $values) {
            $getDataArray[] = [
                "id" => HelperService::encrypt($values['number_client_id']),
                "title" => $values['title'],
                "short_description" => $values['short_description'],
                "icon_image_ori" => $values['icon_image_ori'],
                "icon_image" => $values['icon_image'],
            ];
        }
        return HelperService::success($msg, $getDataArray);
    }

    public function WeDoHome(Request $request)
    {
        $msg = "success get data WeDo";
        $getData = WeDo::Home();
        $getData->orderBy('wedo.sort', 'DESC');
        $getData->orderBy('created_at', 'DESC');
        $getData->orderBy('updated_at', 'ASC');
        $getData = $getData->get();
        $getDataArray = [];
        foreach ($getData as $values) {
            $getDataArray[] = [
                "id" => HelperService::encrypt($values['number_client_id']),
                "title" => $values['title'],
                "short_description" => $values['short_description'],
                "icon_image_ori" => $values['icon_image_ori'],
                "icon_image" => $values['icon_image'],
            ];
        }
        return HelperService::success($msg, $getDataArray);
    }

}
