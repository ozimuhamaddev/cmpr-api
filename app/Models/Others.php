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
        return Self::select('title', 'others.menu_id', 'short_description', 'description', 'menu_name', 'image_ori', 'image', 'icon_image', 'icon_image_ori', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->join('menu', 'others.menu_id', 'menu.menu_id')
            ->LeftJoin('icon', 'others.icon_id', 'icon.icon_id')
            ->where('others.active', 'Y')
            ->orderBy('others.sort', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'ASC')
            ->get();
    }

    public static function Testimoni()
    {
        return Self::select('title', 'others.menu_id', 'short_description', 'description', 'menu_name', 'image_ori', 'image', 'icon_image', 'icon_image_ori', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->join('menu', 'others.menu_id', 'menu.menu_id')
            ->LeftJoin('icon', 'others.icon_id', 'icon.icon_id')
            ->where('others.active', 'Y')
            ->where('menu.menu_id', 6)
            ->orderBy('others.sort', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'ASC')
            ->get();
    }
}
