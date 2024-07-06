<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'projects_id';
    public $timestamps = false;


    protected $fillable = [
        'title',
        'proj_category_id',
        'short_description',
        'description',
        'image',
        'image_ori',
        'updated_at',
        'created_at'
    ];

    public static function ProjectsAll()
    {
        return Self::select('projects_id', 'title', 'short_description', 'description', 'image_ori', 'image', 'icon_image', 'icon_image_ori', 'proj_category_name', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->join('projects_category', 'projects.proj_category_id', 'projects_category.proj_category_id')
            ->LeftJoin('icon', 'projects.icon_id', 'icon.icon_id')
            ->where('projects.active', 'Y');
    }

    public static function Home()
    {
        return Self::select('title', 'short_description', 'description', 'image_ori', 'image', 'icon_image', 'icon_image_ori', 'proj_category_name', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->join('projects_category', 'projects.proj_category_id', 'projects_category.proj_category_id')
            ->LeftJoin('icon', 'projects.icon_id', 'icon.icon_id')
            ->where('projects.active', 'Y')
            ->orderBy('projects.sort', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'ASC')
            ->limit(30)
            ->get();
    }

    public static function ProjectsCategory()
    {
        return DB::table('projects_category')
            ->select('proj_category_id', 'proj_category_name')
            ->where('active', "Y");
    }

    public static function Detail($projects_id)
    {
        return Self::select('projects_id', 'title', 'short_description', 'description',  'image_ori', 'image', 'icon_id', 'proj_category_name', 'projects.proj_category_id', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->join('projects_category', 'projects.proj_category_id', 'projects_category.proj_category_id')
            ->where('projects_id', $projects_id)
            ->first();
    }

    public static function AddProjects($param)
    {
        return Self::create($param);
    }

    public static function UpdateProjects($param, $projects_id)
    {
        return Self::where('projects_id', $projects_id)
            ->update($param);
    }


    public static function AddCategory($param)
    {
        return DB::table('projects_category')->insert($param);
    }

    public static function UpdateCategory($param, $proj_category_id)
    {
        return DB::table('projects_category')
            ->where('proj_category_id', $proj_category_id)
            ->update($param);
    }

    public static function MasterCategoryDetail($proj_category_id)
    {
        return DB::table('projects_category')
            ->select('proj_category_name', 'proj_category_id')
            ->where('proj_category_id', $proj_category_id)
            ->first();
    }
}
