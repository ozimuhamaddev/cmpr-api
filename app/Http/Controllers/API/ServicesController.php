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
        return HelperService::_success($msg, $getDataArray);
    }


    public function Detail(Request $request)
    {
        $services_id = HelperService::decrypt($request->id);
        $msg = "success get data banner";
        $getData = Services::Detail($services_id);
        return HelperService::_success($msg, $getData);
    }
}
