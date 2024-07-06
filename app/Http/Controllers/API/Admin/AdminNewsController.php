<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Helpers\HelperService;


class AdminNewsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('length', $request->input('per_page', 25)); // Default to 10 items per page if not provided
        $page = $request->input('start') !== null
            ? ($request->input('start') / $perPage) + 1
            : $request->input('page', 1); // Default to page 1 if not provided

        // Apply the filter before paginating
        $query = News::ListAll();
        $query->orderBy('news.news_id', 'DESC');
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

    public function doAdd(Request $request)
    {

        $category_id = HelperService::decrypt($request->category_id);
        $param = [
            "title" => $request->title,
            "category_id" => $category_id,
            "tag" => $request->tag,
            "short_description" => $request->short_description,
            "description" => $request->description,
            "updated_at" => date("Y-m-d H:i:s"),
        ];

        if ($request->image != "") {
            $param["image"] = $request->image;
            $param["image_ori"] = $request->image_ori;
        }

        if ($request->id != "") {
            $news_id = HelperService::decrypt($request->id);
            News::UpdateNews($param, $news_id);
        } else {
            $param["created_at"] = date("Y-m-d H:i:s");
            News::AddNews($param);
        }

        $msg = "success update news";
        return HelperService::success($msg, []);
    }

    public function doDelete(Request $request)
    {

        $param = [
            "active" => "N",
            "updated_at" => date("Y-m-d H:i:s")
        ];
        $news_id = HelperService::decrypt($request->id);
        News::UpdateNews($param, $news_id);

        $msg = "success update news";
        return HelperService::success($msg, []);
    }


    public function indexCategory(Request $request)
    {
        $perPage = $request->input('length', $request->input('per_page', 25)); // Default to 10 items per page if not provided
        $page = $request->input('start') !== null
            ? ($request->input('start') / $perPage) + 1
            : $request->input('page', 1); // Default to page 1 if not provided

        // Apply the filter before paginating
        $query = News::Category();
        $query->orderBy('category.category_id', 'DESC');
        $getData = $query->paginate($perPage, ['*'], 'page', $page);
        $data = $getData->map(function ($item) {
            return [
                'id' => HelperService::encrypt($item->category_id),
                'category_name' => $item->category_name
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

    public function doAddCategory(Request $request)
    {
        $param = [
            "category_name" => $request->category_name,
        ];

        if ($request->id != "") {
            $category_id = HelperService::decrypt($request->id);
            News::UpdateCategory($param, $category_id);
        } else {
            News::AddCategory($param);
        }

        $msg = "success update news";
        return HelperService::success($msg, []);
    }

    public function doDeleteCategory(Request $request)
    {

        $param = [
            "active" => "N"
        ];
        $category_id = HelperService::decrypt($request->id);
        News::UpdateCategory($param, $category_id);

        $msg = "success update news";
        return HelperService::success($msg, []);
    }


    public function masterCategoryDetail(Request $request)
    {
        $category_id = HelperService::decrypt($request->id);
        $msg = "success get data news";
        $data = News::MasterCategoryDetail($category_id);
        return HelperService::success($msg, $data);
    }
}
