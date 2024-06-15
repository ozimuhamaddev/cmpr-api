<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'projects_id';
    public $timestamps = false;


    public static function Home()
    {
        return Self::select('title', 'content', 'image_ori', 'image', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->join('projects_category', 'projects.proj_category_id', 'projects_category.proj_category_id')
            ->where('active', 'Y')
            ->orderBy('sort', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'ASC')
            ->limit(6)
            ->get();
    }
}
