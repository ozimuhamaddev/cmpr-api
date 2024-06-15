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
        return Self::select('title', 'content', 'image_ori', 'image', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->where('active', 'Y')
            ->orderBy('sort', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'ASC')
            ->limit(6)
            ->get();
    }
}
