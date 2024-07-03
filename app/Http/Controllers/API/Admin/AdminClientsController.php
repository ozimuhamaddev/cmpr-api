<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Helpers\HelperService;


class AdminClientsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('length', $request->input('per_page', 25)); // Default to 10 items per page if not provided
        $page = $request->input('start') !== null
            ? ($request->input('start') / $perPage) + 1
            : $request->input('page', 1); // Default to page 1 if not provided

        // Apply the filter before paginating
        $query = Clients::Home();
        $query = $query->orderBy('clients.clients_id', 'DESC');
        $getData = $query->paginate($perPage, ['*'], 'page', $page);
        $data = $getData->map(function ($item) {
            return [
                'id' => HelperService::encrypt($item->clients_id),
                'title' => $item->title,
                'image_ori' => $item->image_ori,
                'image' => $item->image,
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
            "updated_at" => date("Y-m-d H:i:s"),
        ];

        if ($request->image != "") {
            $param["image"] = $request->image;
            $param["image_ori"] = $request->image_ori;
        }

        if ($request->id != "") {
            $clients_id = HelperService::decrypt($request->id);
            Clients::UpdateClients($param, $clients_id);
        } else {
            $param["created_at"] = date("Y-m-d H:i:s");
            Clients::AddClients($param);
        }

        $msg = "success update clients";
        return HelperService::success($msg, []);
    }

    public function doDelete(Request $request)
    {
        $param = [
            "active" => "N",
            "updated_at" => date("Y-m-d H:i:s")
        ];
        $clients_id = HelperService::decrypt($request->id);
        Clients::Updateclients($param, $clients_id);

        $msg = "success update clients";
        return HelperService::success($msg, []);
    }

    public function Detail(Request $request)
    {
        $clients_id = HelperService::decrypt($request->id);
        $msg = "success get data clients";
        $getData = Clients::Detail($clients_id);
        $getDataArray = [
            "id" => HelperService::encrypt($getData->clients_id),
            "title" => $getData->title,
            "image_ori" => $getData->image_ori,
            "image" => $getData->image,
            "created_at" => $getData->created_at,
            "created_by" => $getData->created_by,
            "updated_at" => $getData->updated_at,
            "updated_by" => $getData->updated_by,
        ];
        return HelperService::success($msg, $getDataArray);
    }
}
