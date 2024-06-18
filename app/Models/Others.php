<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Others extends Model
{
    protected $table = 'others';
    protected $primaryKey = 'others_id';
    public $timestamps = false;

    public static function Home()
    {
        return Self::select('title', 'others.others_category_id', 'short_description', 'description', 'others_category_name', 'image_ori', 'image', 'icon_image', 'icon_image_ori', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->join('others_category', 'others.others_category_id', 'others_category.others_category_id')
            ->LeftJoin('icon', 'others.icon_id', 'icon.icon_id')
            ->where('others.active', 'Y')
            ->orderBy('sort', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'ASC')
            ->get();
    }

    public static function Testimoni()
    {
        return Self::select('title', 'others.others_category_id', 'short_description', 'description', 'others_category_name', 'image_ori', 'image', 'icon_image', 'icon_image_ori', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->join('others_category', 'others.others_category_id', 'others_category.others_category_id')
            ->LeftJoin('icon', 'others.icon_id', 'icon.icon_id')
            ->where('others.active', 'Y')
            ->where('others_category.others_category_id', 6)
            ->orderBy('sort', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'ASC')
            ->get();
    }
}
