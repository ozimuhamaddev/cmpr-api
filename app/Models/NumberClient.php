<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NumberClient extends Model
{
    protected $table = 'number_client';
    protected $primaryKey = 'number_client_id';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'icon_id',
        'updated_at',
        'created_at'
    ];
    public static function Home()
    {
        return Self::select('number_client_id', 'title', 'short_description', 'number_client.icon_id', 'icon_image_ori', 'icon_image', 'created_at', 'updated_at')
            ->LeftJoin('icon', 'number_client.icon_id', 'icon.icon_id')
            ->where('number_client.active', 'Y');
    }

    public static function Detail($number_client_id)
    {
        return Self::select('number_client_id', 'title', 'short_description',  'image_ori', 'image',  'number_client.icon_id', 'icon_image_ori', 'icon_image', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->LeftJoin('icon', 'number_client.icon_id', 'icon.icon_id')
            ->where('number_client_id', $number_client_id)
            ->first();
    }

    public static function AddNumberClient($param)
    {
        return Self::create($param);
    }

    public static function UpdateNumberClient($param, $number_client_id)
    {
        return Self::where('number_client_id', $number_client_id)
            ->update($param);
    }
}
