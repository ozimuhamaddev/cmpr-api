<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NumberClient;
use App\Helpers\HelperService;


class AdminNumberClientController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('length', $request->input('per_page', 25)); // Default to 10 items per page if not provided
        $page = $request->input('start') !== null
            ? ($request->input('start') / $perPage) + 1
            : $request->input('page', 1); // Default to page 1 if not provided

        // Apply the filter before paginating
        $query = NumberClient::Home();
        $query = $query->orderBy('number_client.number_client_id', 'DESC');
        $getData = $query->paginate($perPage, ['*'], 'page', $page);
        $data = $getData->map(function ($item) {
            return [
                'id' => HelperService::encrypt($item->number_client_id),
                'title' => $item->title,
                'short_description' => $item->short_description,
                'icon_id' => HelperService::encrypt($item->icon_id),
                "icon_image" => $item->icon_image,
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
            "short_description" => $request->short_description,
            "icon_id" => $icon_id,
            "updated_at" => date("Y-m-d H:i:s"),
        ];

        if ($request->id != "") {
            $number_client_id = HelperService::decrypt($request->id);
            NumberClient::UpdateNumberClient($param, $number_client_id);
        } else {
            $param["created_at"] = date("Y-m-d H:i:s");
            NumberClient::AddNumberClient($param);
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
        $number_client_id = HelperService::decrypt($request->id);
        NumberClient::UpdateNumberClient($param, $number_client_id);

        $msg = "success update banner";
        return HelperService::success($msg, []);
    }

    public function Detail(Request $request)
    {
        $number_client_id = HelperService::decrypt($request->id);
        $msg = "success get data banner";
        $getData = NumberClient::Detail($number_client_id);
        $getDataArray = [
            "id" => HelperService::encrypt($getData->number_client_id),
            "title" => $getData->title,
            "short_description" => $getData->short_description,
            "icon_id" => HelperService::encrypt($getData->icon_id),
            "icon_image" => $getData->icon_image,
            "icon_image_ori" => $getData->icon_image_ori,
            "created_at" => $getData->created_at,
            "created_by" => $getData->created_by,
            "updated_at" => $getData->updated_at,
            "updated_by" => $getData->updated_by,
        ];
        return HelperService::success($msg, $getDataArray);
    }
}
