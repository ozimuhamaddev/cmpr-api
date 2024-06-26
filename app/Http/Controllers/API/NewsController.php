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

        $dataCategory = News::Category();
        $getDataArray = [];
        foreach ($dataCategory as $values) {
            $getDataArray[] = [
                "id" => HelperService::encrypt($values->category_id),
                "category_name" => $values->category_name,
            ];
        }
        $data['getCategory'] = $getDataArray;
        return HelperService::success($msg, $data);
    }


    public function Tags(Request $request)
    {
        $data = News::Tags();
        $msg = "success get data news";
        return HelperService::success($msg, $data);
    }

    public function Category(Request $request)
    {
        $data = News::Category();
        $getDataArray = [];
        foreach ($data as $values) {
            $getDataArray[] = [
                "id" => HelperService::encrypt($values->category_id),
                "category_name" => $values->category_name,
            ];
        }

        $msg = "success get data news";
        return HelperService::success($msg, $getDataArray);
    }


    public function tagsDetail(Request $request)
    {
        $id = $request->id;

        $perPage = $request->input('length', $request->input('per_page', 10)); // Default to 10 items per page if not provided
        $page = $request->input('start') !== null
            ? ($request->input('start') / $perPage) + 1
            : $request->input('page', 1); // Default to page 1 if not provided

        // Apply the filter before paginating
        $query = News::TagsDetail($id);
        $getData = $query->paginate($perPage, ['*'], 'page', $page);
        $data = $getData->map(function ($item) {
            return [
                'id' => HelperService::encrypt($item->news_id),
                'title' => $item->title,
                'short_description' => $item->short_description,
                'description' => $item->description,
                'image_ori' => $item->image_ori,
                'image' => $item->image,
                'icon_id' => $item->icon_id,
                'tag' => $item->tag,
                'category_name' => $item->category_name,
                'created_at' => $item->created_at,
                'created_by' => $item->created_by,
                'updated_at' => $item->updated_at,
                'updated_by' => $item->updated_by
            ];
        });





        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $getData->total(),
            'recordsFiltered' => $getData->total(),
            'data' => $data,
            'current_page' => $getData->currentPage(), // Halaman saat ini
            'last_page' => $getData->lastPage() // Halaman terakhir
        ]);
    }

    public function categoryDetail(Request $request)
    {
        $id = HelperService::decrypt($request->id);

        $perPage = $request->input('length', $request->input('per_page', 10)); // Default to 10 items per page if not provided
        $page = $request->input('start') !== null
            ? ($request->input('start') / $perPage) + 1
            : $request->input('page', 1); // Default to page 1 if not provided

        // Apply the filter before paginating
        $query = News::CategoryDetail($id);
        $getData = $query->paginate($perPage, ['*'], 'page', $page);

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
}
