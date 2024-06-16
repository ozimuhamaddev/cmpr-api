<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'services_id';
    public $timestamps = false;


    public static function Home()
    {
        return Self::select('title', 'short_description', 'description', 'image_ori', 'image', 'icon_image', 'icon_image_ori', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->LeftJoin('icon', 'services.icon_id', 'icon.icon_id')
            ->where('active', 'Y')
            ->orderBy('sort', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'ASC')
            ->limit(6)
            ->get();
    }
}
