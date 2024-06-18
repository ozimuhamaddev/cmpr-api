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
        $perPage = $request->input('length', $request->input('per_page', 10)); // Default to 10 items per page if not provided
        $page = $request->input('start') !== null
            ? ($request->input('start') / $perPage) + 1
            : $request->input('page', 1); // Default to page 1 if not provided

        $getData = News::paginate($perPage, ['*'], 'page', $page);

        // Encrypt the 'news_id' for each item
        $data = $getData->items();
        $encryptedData = array_map(function ($item) {
            return array_merge($item->toArray(), [
                'id' => HelperService::encrypt($item->news_id)
            ]);
        }, $data);

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $getData->total(),
            'recordsFiltered' => $getData->total(),
            'data' => $encryptedData,
            'current_page' => $getData->currentPage(), // Halaman saat ini
            'last_page' => $getData->lastPage() // Halaman terakhir
        ]);
    }

    public function Detail(Request $request)
    {

        $news_id = HelperService::decrypt($request->id);
        $msg = "success get data news";
        $data = [];

        $data['getDetail'] = News::Detail($news_id);
        $getData = News::Other($news_id);
        $getDataArray = [];
        foreach ($getData as $values) {
            $getDataArray[] = [
                "id" => HelperService::encrypt($values['news_id']),
                "title" => $values['title'],
                "image_ori" => $values['image_ori'],
                "image" => $values['image'],
                "created_at" => $values['created_at'],
                "created_by" => $values['created_by'],
                "updated_at" => $values['updated_at'],
                "updated_by" => $values['updated_by']
            ];
        }

        $data['getOther'] = $getDataArray;
        $data['getTag'] = News::Tags();
        $data['getCategory'] = News::Category();

        return HelperService::_success($msg, $data);
    }


    public function Tags(Request $request)
    {
        $data = News::Tags();
        $msg = "success get data news";
        return HelperService::_success($msg, $data);
    }

    public function Category(Request $request)
    {
        $data = News::Category();
        $msg = "success get data news";
        return HelperService::_success($msg, $data);
    }
}
