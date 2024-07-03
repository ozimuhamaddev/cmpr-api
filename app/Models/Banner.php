<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banner';
    protected $primaryKey = 'banner_id';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'sub_title',
        'image',
        'image_ori',
        'updated_at',
        'created_at'
    ];
    public static function Home()
    {
        return Self::select('banner_id','title', 'sub_title', 'image_ori', 'image', 'created_at', 'updated_at')
            ->where('active', 'Y');
    }

    public static function Detail($banner_id)
    {
        return Self::select('banner_id', 'title', 'sub_title',  'image_ori', 'image', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->where('banner_id', $banner_id)
            ->first();
    }

    public static function AddBanner($param)
    {
        return Self::create($param);
    }

    public static function UpdateBanner($param, $banner_id)
    {
        return Self::where('banner_id', $banner_id)
            ->update($param);
    }
}
