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
                "created_at" => HelperService::formatDate($values['created_at']),
                "created_by" => $values['created_by'],
                "updated_at" => HelperService::formatDate($values['updated_at']),
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










'20240627-164-01-08',	
'20240627-180-01-04',	
'20240627-183-01-01',	
'20240627-345-01-02',	
'20240627-350-01-21',	
'20240627-368-01-16',	
'20240627-378-01-15',	
'20240627-381-01-12',	
'20240627-403-01-10',	
'20240627-404-01-09',	
'20240627-432-01-14',	
'20240627-443-01-03',	
'20240627-505-01-06',	
'20240627-533-01-18',	
'20240627-628-01-11',	
'20240627-633-01-05',	
'20240627-766-01-13',	
'20240627-805-01-17',	
'20240627-865-01-19',	
'20240627-888-01-07',	
'20240627-945-01-20',	
