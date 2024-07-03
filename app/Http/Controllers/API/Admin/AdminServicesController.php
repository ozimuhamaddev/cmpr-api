<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Services;
use App\Helpers\HelperService;


class AdminServicesController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('length', $request->input('per_page', 25)); // Default to 10 items per page if not provided
        $page = $request->input('start') !== null
            ? ($request->input('start') / $perPage) + 1
            : $request->input('page', 1); // Default to page 1 if not provided

        // Apply the filter before paginating
        $query = Services::ServicesAll();
        $query->orderBy('services.services_id', 'DESC');
        $getData = $query->paginate($perPage, ['*'], 'page', $page);
        $data = $getData->map(function ($item) {
            return [
                'id' => HelperService::encrypt($item->services_id),
                'title' => $item->title,
                'short_description' => $item->short_description,
                'description' => $item->description,
                'image_ori' => $item->image_ori,
                'image' => $item->image,
                'icon_id' => HelperService::encrypt($item->icon_id),
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

        $icon_id = HelperService::decrypt($request->icon_id);
        $param = [
            "title" => $request->title,
            "icon_id" => $icon_id,
            "short_description" => $request->short_description,
            "description" => $request->description,
            "updated_at" => date("Y-m-d H:i:s"),
        ];

        if ($request->image != "") {
            $param["image"] = $request->image;
            $param["image_ori"] = $request->image_ori;
        }

        if ($request->id != "") {
            $services_id = HelperService::decrypt($request->id);
            Services::UpdateServices($param, $services_id);
        } else {
            $param["created_at"] = date("Y-m-d H:i:s");
            Services::AddServices($param);
        }

        $msg = "success update services";
        return HelperService::success($msg, []);
    }

    public function doDelete(Request $request)
    {

        $param = [
            "active" => "N",
            "updated_at" => date("Y-m-d H:i:s")
        ];
        $services_id = HelperService::decrypt($request->id);
        services::UpdateServices($param, $services_id);

        $msg = "success update services";
        return HelperService::success($msg, []);
    }
}
