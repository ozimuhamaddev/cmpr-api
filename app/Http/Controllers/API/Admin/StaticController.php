<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Helpers\HelperService;
use App\Models\Others;

class StaticController extends Controller
{
    public function index(Request $request)
    {
        $menu_id = HelperService::decrypt($request->id);
        $data = Others::DetailSingle($menu_id);

        $msg = "success get data static";
        return HelperService::success($msg, $data);
    }

    public function doAddStatic(Request $request)
    {
        $menu_id = HelperService::decrypt($request->id);

        $param = [
            "description" => $request->description,
            "updated_at" => date("Y-m-d H:i:s"),
        ];

        $data = Others::UpdateOthers($param, $menu_id);

        $msg = "success get data static";
        return HelperService::success($msg, $data);
    }

    public function doAddStaticImage(Request $request)
    {
        $menu_id = HelperService::decrypt($request->id);

        if ($request->image != "") {
            $param = [
                "image" => $request->image,
                "image_ori" => $request->image_ori,
                "updated_at" => date("Y-m-d H:i:s"),
            ];

            $data = Others::UpdateOthers($param, $menu_id);
        }

        $msg = "success get data static";
        return HelperService::success($msg, $data);
    }
}
