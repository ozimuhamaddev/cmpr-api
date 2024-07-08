<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\HelperService;
use App\Models\Services;
use App\Models\Others;



class ServicesController extends Controller
{
    public function index(Request $request)
    {
        $msg = "success get data banner";
        $getData = Services::ServicesAll();
        $getData->orderBy('sort', 'DESC');
        $getData->orderBy('created_at', 'DESC');
        $getData->orderBy('updated_at', 'ASC');
        $getData = $getData->get();
        $getDataArray = [];
        foreach ($getData as $values) {
            $getDataArray[] = [
                "id" => HelperService::encrypt($values['services_id']),
                "title" => $values['title'],
                "description" => $values['description'],
                "short_description" => $values['short_description'],
                "image_ori" => $values['image_ori'],
                "image" => $values['image'],
                "icon_id" => HelperService::encrypt($values['icon_id']),
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


    public function Detail(Request $request)
    {
        $services_id = HelperService::decrypt($request->id);
        $msg = "success get data banner";
        $getData = Services::Detail($services_id);
        $getDataArra = [
            "id" => HelperService::encrypt($getData->services_id),
            "title" => $getData->title,
            "description" => $getData->description,
            "short_description" => $getData->short_description,
            "image_ori" => $getData->image_ori,
            "image" => $getData->image,
            "icon_id" => HelperService::encrypt($getData->icon_id),
            "icon_image" => $getData->icon_image,
            "icon_image_ori" => $getData->icon_image_ori,
            "created_at" => HelperService::formatDate($getData->created_at),
            "created_by" => $getData->created_by,
            "updated_at" => HelperService::formatDate($getData->updated_at),
            "updated_by" => $getData->updated_by,
        ];
        return HelperService::success($msg, $getDataArra);
    }
}
