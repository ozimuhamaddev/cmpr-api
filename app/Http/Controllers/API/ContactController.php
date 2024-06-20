<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\HelperService;
use App\Models\Contact;



class ContactController extends Controller
{
    public function index(Request $request)
    {
        $msg = "success get data banner";
        $getData = Contact::Detail();
        return HelperService::success($msg, $getData);
    }
}
