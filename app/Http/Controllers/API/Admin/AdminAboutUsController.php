<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Helpers\HelperService;
use App\Models\AboutUs;

class AdminAboutUsController extends Controller
{

    public function doUpdate(Request $request)
    {

        if ($request->image != "") {
            $param = [
                "image" => $request->image,
                "image_ori" => $request->image_ori,
                "short_description" => $request->short_description,
                "description" => $request->description,
                "updated_at" => date("Y-m-d H:i:s"),
            ];
        } else {
            $param = [
                "short_description" => $request->short_description,
                "description" => $request->description,
                "updated_at" => date("Y-m-d H:i:s"),
            ];
        }

        $data = AboutUs::UpdateAbout($param);

        $msg = "success get data static";
        return HelperService::success($msg, $data);
    }
}
