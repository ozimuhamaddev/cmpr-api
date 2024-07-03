<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\HelperService;
use App\Models\Banner;
use App\Models\AboutUs;
use App\Models\Projects;
use App\Models\Services;
use App\Models\News;
use App\Models\Contact;



class ProjectsController extends Controller
{
    public function index(Request $request)
    {
        $msg = "success get data projects";
        $getData = Projects::ProjectsAll();
        $getData->orderBy('projects.sort', 'DESC');
        $getData->orderBy('created_at', 'DESC');
        $getData->orderBy('updated_at', 'ASC');
        $getData = $getData->get();

        $getDataArray = [];
        foreach ($getData as $values) {
            $getDataArray[] = [
                "id" => HelperService::encrypt($values['project_id']),
                "title" => $values['title'],
                "description" => $values['description'],
                "short_description" => $values['short_description'],
                "image_ori" => $values['image_ori'],
                "image" => $values['image'],
                "icon_image" => $values['icon_image'],
                "icon_image_ori" => $values['icon_image_ori'],
                "proj_category_name" => $values['proj_category_name'],
                "created_at" => $values['created_at'],
                "created_by" => $values['created_by'],
                "updated_at" => $values['updated_at'],
                "updated_by" => $values['updated_by']
            ];
        }
        return HelperService::success($msg, $getDataArray);
    }
}
