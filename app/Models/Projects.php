<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'projects_id';
    public $timestamps = false;


    public static function Home()
    {
        return Self::select('title', 'short_description', 'description', 'image_ori', 'image', 'icon_image', 'icon_image_ori', 'proj_category_name', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->join('projects_category', 'projects.proj_category_id', 'projects_category.proj_category_id')
            ->LeftJoin('icon', 'projects.icon_id', 'icon.icon_id')
            ->where('projects.active', 'Y')
            ->orderBy('sort', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'ASC')
            ->limit(6)
            ->get();
    }


    public static function ProjectsCategory()
    {
        return DB::table('projects_category')
            ->select('proj_category_name')
            ->where('active', 'Y')
            ->get();
    }
}
