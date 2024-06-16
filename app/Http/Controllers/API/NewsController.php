<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\HelperService;
use App\Models\News;



class NewsController extends Controller
{
    public function index(Request $request)
    {
        $msg = "success get data news";
        $getData = News::Page();
        return HelperService::_success($msg, $getData);
    }

    public function Detail(Request $request)
    {

        $news_id = HelperService::decrypt($request->id);
        $msg = "success get data news";
        $data = [];

        $data['getDetail'] = News::Detail($news_id);
        $data['getOther'] = News::Other($news_id);
        $data['getTag'] = News::Tag();

        return HelperService::_success($msg, $data);
    }
}
