<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Helpers\HelperService;
use App\Models\Others;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $menu_id = HelperService::decrypt($request->id);
        $data = Others::DetailSingle($menu_id);

        $msg = "success get data static";
        return HelperService::success($msg, $data);
    }
}
