<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\HelperService;
use App\Models\Projects;

class AdminProjectsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('length', $request->input('per_page', 25)); // Default to 10 items per page if not provided
        $page = $request->input('start') !== null
            ? ($request->input('start') / $perPage) + 1
            : $request->input('page', 1); // Default to page 1 if not provided

        // Apply the filter before paginating
        $query = Projects::ProjectsAll();
        $query->orderBy('projects.projects_id', 'DESC');
        $getData = $query->paginate($perPage, ['*'], 'page', $page);
        $data = $getData->map(function ($item) {
            return [
                'id' => HelperService::encrypt($item->projects_id),
                'title' => $item->title,
                'short_description' => $item->short_description,
                'description' => $item->description,
                'image_ori' => $item->image_ori,
                'image' => $item->image,
                'icon_id' => $item->icon_id,
                'tag' => $item->tag,
                'proj_category_name' => $item->proj_category_name,
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
        $proj_category_id = HelperService::decrypt($request->proj_category_id);
        $param = [
            "title" => $request->title,
            "proj_category_id" => $proj_category_id,
            "short_description" => $request->short_description,
            "description" => $request->description,
            "updated_at" => date("Y-m-d H:i:s"),
        ];

        if ($request->image != "") {
            $param["image"] = $request->image;
            $param["image_ori"] = $request->image_ori;
        }

        if ($request->id != "") {
            $projects_id = HelperService::decrypt($request->id);
            Projects::UpdateProjects($param, $projects_id);
        } else {
            $param["created_at"] = date("Y-m-d H:i:s");
            Projects::AddProjects($param);
        }

        $msg = "success update projects";
        return HelperService::success($msg, []);
    }

    public function Detail(Request $request)
    {
        $projects_id = HelperService::decrypt($request->id);

        $msg = "success get data news";
        $data = [];

        $detail = Projects::Detail($projects_id);
        $data['getDetail'] = [
            'id' => HelperService::encrypt($detail->projects_id),
            'title' => $detail->title,
            'short_description' => $detail->short_description,
            'description' => $detail->description,
            'image_ori' => $detail->image_ori,
            'image' => $detail->image,
            'icon_id' => $detail->icon_id,
            'proj_category_name' => $detail->proj_category_name,
            'proj_category_id' =>  HelperService::encrypt($detail->proj_category_id),
            'created_at' => $detail->created_at,
            'created_by' => $detail->created_by,
            'updated_at' => $detail->updated_at,
            'updated_by' => $detail->updated_by
        ];
        return HelperService::success($msg, $data);
    }


    public function doDelete(Request $request)
    {

        $param = [
            "active" => "N",
            "updated_at" => date("Y-m-d H:i:s")
        ];
        $projects_id = HelperService::decrypt($request->id);
        Projects::UpdateProjects($param, $projects_id);

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
        $query = Projects::ProjectsCategory();
        $query->orderBy('projects_category.proj_category_id', 'DESC');
        $getData = $query->paginate($perPage, ['*'], 'page', $page);
        $data = $getData->map(function ($item) {
            return [
                'id' => HelperService::encrypt($item->proj_category_id),
                'proj_category_name' => $item->proj_category_name
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
            "proj_category_name" => $request->proj_category_name,
        ];

        if ($request->id != "") {
            $proj_category_id = HelperService::decrypt($request->id);
            Projects::UpdateCategory($param, $proj_category_id);
        } else {
            Projects::AddCategory($param);
        }

        $msg = "success update news";
        return HelperService::success($msg, []);
    }

    public function doDeleteCategory(Request $request)
    {

        $param = [
            "active" => "N"
        ];
        $news_id = HelperService::decrypt($request->id);
        Projects::UpdateCategory($param, $news_id);

        $msg = "success update news";
        return HelperService::success($msg, []);
    }


    public function masterCategoryDetail(Request $request)
    {
        $proj_category_id = HelperService::decrypt($request->id);
        $msg = "success get data news";
        $data = Projects::MasterCategoryDetail($proj_category_id);
        return HelperService::success($msg, $data);
    }
}
