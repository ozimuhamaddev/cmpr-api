<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';
    protected $primaryKey = 'contact_id';
    public $timestamps = false;


    public static function Home()
    {
        return Self::select('title', 'sub_title', 'image_ori', 'image', 'created_at', 'updated_at')
            ->where('active', 'Y')
            ->orderBy('sort', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'ASC')
            ->get();
    }
}
