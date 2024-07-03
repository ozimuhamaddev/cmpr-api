<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    protected $table = 'icon';
    protected $primaryKey = 'icon_id';
    public $timestamps = false;

    public static function getData()
    {
        return Self::select('icon_id', 'icon_image', 'icon_image_ori')
            ->orderBy('icon.icon_id', 'DESC')
            ->get();
    }
}
