<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeDo extends Model
{
    protected $table = 'wedo';
    protected $primaryKey = 'wedo_id';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'icon_id',
        'updated_at',
        'created_at'
    ];
    public static function Home()
    {
        return Self::select('wedo_id', 'title', 'short_description',  'icon_image_ori', 'icon_image', 'created_at', 'updated_at')
            ->LeftJoin('icon', 'wedo.icon_id', 'icon.icon_id')
            ->where('active', 'Y');
    }

    public static function Detail($wedo_id)
    {
        return Self::select('wedo_id', 'title', 'short_description',  'image_ori', 'image',  'icon_image_ori', 'icon_image', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->LeftJoin('icon', 'wedo.icon_id', 'icon.icon_id')
            ->where('wedo_id', $wedo_id)
            ->first();
    }

    public static function AddWeDo($param)
    {
        return Self::create($param);
    }

    public static function UpdateWeDo($param, $wedo_id)
    {
        return Self::where('wedo_id', $wedo_id)
            ->update($param);
    }
}
