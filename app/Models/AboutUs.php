<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us';
    protected $primaryKey = 'about_us_id';
    public $timestamps = false;


    public static function Home()
    {
        return Self::select('title', 'short_description', 'description', 'image_ori', 'image', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'ASC')
            ->get();
    }
}
