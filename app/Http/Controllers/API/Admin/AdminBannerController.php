<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Helpers\HelperService;


class AdminBannerController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('length', $request->input('per_page', 25)); // Default to 10 items per page if not provided
        $page = $request->input('start') !== null
            ? ($request->input('start') / $perPage) + 1
            : $request->input('page', 1); // Default to page 1 if not provided

        // Apply the filter before paginating
        $query = Banner::Home();
        $query = $query->orderBy('banner.banner_id', 'DESC');
        $getData = $query->paginate($perPage, ['*'], 'page', $page);
        $data = $getData->map(function ($item) {
            return [
                'id' => HelperService::encrypt($item->banner_id),
                'title' => $item->title,
                'sub_title' => $item->sub_title,
                'image_ori' => $item->image_ori,
                'image' => $item->image,
                'created_at' => HelperService::formatDate($item->created_at),
                'created_by' => $item->created_by,
                'updated_at' => HelperService::formatDate($item->updated_at),
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

        $icon_id = HelperService::decrypt($request->icon_id);
        $param = [
            "title" => $request->title,
            "sub_title" => $request->sub_title,
            "updated_at" => date("Y-m-d H:i:s"),
        ];

        if ($request->image != "") {
            $param["image"] = $request->image;
            $param["image_ori"] = $request->image_ori;
        }

        if ($request->id != "") {
            $banner_id = HelperService::decrypt($request->id);
            Banner::UpdateBanner($param, $banner_id);
        } else {
            $param["created_at"] = date("Y-m-d H:i:s");
            Banner::AddBanner($param);
        }

        $msg = "success update banner";
        return HelperService::success($msg, []);
    }

    public function doDelete(Request $request)
    {
        $param = [
            "active" => "N",
            "updated_at" => date("Y-m-d H:i:s")
        ];
        $banner_id = HelperService::decrypt($request->id);
        banner::Updatebanner($param, $banner_id);

        $msg = "success update banner";
        return HelperService::success($msg, []);
    }

    public function Detail(Request $request)
    {
        $banner_id = HelperService::decrypt($request->id);
        $msg = "success get data banner";
        $getData = Banner::Detail($banner_id);
        $getDataArray = [
            "id" => HelperService::encrypt($getData->banner_id),
            "title" => $getData->title,
            "sub_title" => $getData->sub_title,
            "image_ori" => $getData->image_ori,
            "image" => $getData->image,
            "created_at" => HelperService::formatDate($getData->created_at),
            "created_by" => $getData->created_by,
            "updated_at" => HelperService::formatDate($getData->updated_at),
            "updated_by" => $getData->updated_by,
        ];
        return HelperService::success($msg, $getDataArray);
    }
}
