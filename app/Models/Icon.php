<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Icon extends Model
{
    protected $table = 'icon';
    protected $primaryKey = 'icon_id';
    public $timestamps = false;

    public static function getData()
    {
        return Self::select('icon_id', 'icon_name', 'icon_image', 'icon_image_ori')
            ->where('icon.active', 'Y')
            ->orderBy('icon.icon_id', 'DESC');
    }

    public static function AddIcon($param)
    {
        return Self::insert($param);
    }

    public static function UpdateIcon($param, $icon_id)
    {
        return Self::where('icon_id', $icon_id)
            ->update($param);
    }

    public static function Detail($icon_id)
    {
        return Self::select('icon_name', 'icon_image', 'icon_image_ori', 'icon_id')
            ->where('icon_id', $icon_id)
            ->first();
    }
}
