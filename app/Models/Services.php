<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'services_id';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'icon_id',
        'short_description',
        'description',
        'image',
        'image_ori',
        'updated_at',
        'created_at'
    ];

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

    public static function Detail($services_id)
    {
        if ($services_id != "") {
            return Self::select('title', 'short_description', 'description', 'image_ori', 'image', 'services.icon_id', 'icon_image', 'icon_image_ori', 'created_at', 'created_by', 'updated_at', 'updated_by')
                ->LeftJoin('icon', 'services.icon_id', 'icon.icon_id')
                ->where('services_id', $services_id)
                ->orderBy('sort', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->orderBy('updated_at', 'ASC')
                ->first();
        } else {
            return Self::select('title', 'short_description', 'description', 'image_ori', 'image', 'services.icon_id', 'icon_image', 'icon_image_ori', 'created_at', 'created_by', 'updated_at', 'updated_by')
                ->LeftJoin('icon', 'services.icon_id', 'icon.icon_id')
                ->orderBy('sort', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->orderBy('updated_at', 'ASC')
                ->first();
        }
    }

    public static function Other($services_id)
    {
        return Self::select('title')
            ->where('active', 'Y')
            ->where('services_id', '<>', $services_id)
            ->orderBy('sort', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'ASC')
            ->get();
    }

    public static function ServicesAll()
    {
        return Self::select('services_id', 'title', 'short_description', 'description', 'image_ori', 'image', 'services.icon_id', 'icon_image', 'icon_image_ori', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->LeftJoin('icon', 'services.icon_id', 'icon.icon_id')
            ->where('active', 'Y');
    }

    public static function AddServices($param)
    {
        return Self::create($param);
    }

    public static function UpdateServices($param, $services_id)
    {
        return Self::where('services_id', $services_id)
            ->update($param);
    }
}
