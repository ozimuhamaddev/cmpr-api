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
        return Self::select('title', 'description', 'flag', 'image_ori', 'image', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->where('active', 'Y')
            ->orderBy('sort', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'ASC')
            ->limit(6)
            ->get();
    }
}
