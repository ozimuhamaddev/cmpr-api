<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Helpers\HelperService;


class AdminHomeController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('length', $request->input('per_page', 10)); // Default to 10 items per page if not provided
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
}
