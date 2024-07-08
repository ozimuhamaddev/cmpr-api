<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Icon;
use App\Helpers\HelperService;


class AdminHomeController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('length', $request->input('per_page', 25)); // Default to 10 items per page if not provided
        $page = $request->input('start') !== null
            ? ($request->input('start') / $perPage) + 1
            : $request->input('page', 1); // Default to page 1 if not provided

        // Apply the filter before paginating
        $query = Menu::GetMenu();
        $getData = $query->paginate($perPage, ['*'], 'page', $page);

        // Modify the items to only include specific columns and encrypt 'menu_id'
        $data = $getData->map(function ($item) {
            return [
                'id' => HelperService::encrypt($item->menu_id),
                'menu_name' => $item->menu_name, // Include only the 'name' column
                'link' => $item->link, // Include only the 'name' column
                'active' => $item->active, // Include only the 'description' column
                // Add other columns you want to include here
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


    public function doStatusMenu(Request $request)
    {
        $menu_id = HelperService::decrypt($request->id);
        $value = [
            'active' => $request->input('value')
        ];

        Menu::UpdateStatus($menu_id, $value);

        $msg = "success update status";
        return HelperService::success($msg, []);
    }

    public function indexIcon(Request $request)
    {
        $perPage = $request->input('length', $request->input('per_page', 25)); // Default to 10 items per page if not provided
        $page = $request->input('start') !== null
            ? ($request->input('start') / $perPage) + 1
            : $request->input('page', 1); // Default to page 1 if not provided

        // Apply the filter before paginating
        $query = Icon::getData();
        $query->orderBy('icon.icon_id', 'DESC');
        $getData = $query->paginate($perPage, ['*'], 'page', $page);
        $data = $getData->map(function ($item) {
            return [
                'id' => HelperService::encrypt($item->icon_id),
                'icon_name' => $item->icon_name,
                'icon_image' => $item->icon_image,
                'icon_image_ori' => $item->icon_image_ori
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

    public function doAddIcon(Request $request)
    {
        $param = [
            "icon_name" => $request->icon_name,
        ];

        if ($request->icon_image != "") {
            $param["icon_image"] = $request->icon_image;
            $param["icon_image_ori"] = $request->icon_image_ori;
        }

        if ($request->id != "") {
            $icon_id = HelperService::decrypt($request->id);
            Icon::UpdateIcon($param, $icon_id);
        } else {
            Icon::AddIcon($param);
        }

        $msg = "success update icon";
        return HelperService::success($msg, []);
    }

    public function doDeleteIcon(Request $request)
    {
        $param = [
            "active" => "N"
        ];
        $icon_id = HelperService::decrypt($request->id);
        Icon::UpdateIcon($param, $icon_id);

        $msg = "success update icon";
        return HelperService::success($msg, []);
    }


    public function masterIconDetail(Request $request)
    {
        $icon_id = HelperService::decrypt($request->id);
        $msg = "success get data icon";
        $data = Icon::Detail($icon_id);
        return HelperService::success($msg, $data);
    }
}
