<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\HelperService;
use App\Models\Contact;

class AdminContactController extends Controller
{

    public function doUpdate(Request $request)
    {

        $param = [
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'lat' => $request->lat,
            'long' => $request->long,
            "updated_at" => date("Y-m-d H:i:s"),
        ];

        $data = Contact::UpdateContact($param);

        $msg = "success get data static";
        return HelperService::success($msg, $data);
    }
}
