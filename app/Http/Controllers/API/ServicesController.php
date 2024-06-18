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
        $services_id = HelperService::decrypt($request->id);
        $msg = "success get data banner";
        $data = [];
        $data['getDetail'] = Services::Detail($services_id);
        $data['getOther'] = Services::Other($services_id);
        $data['getTestimoni'] = Others::Testimoni();
        return HelperService::_success($msg, $data);
    }
}
