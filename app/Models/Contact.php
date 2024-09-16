<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';
    protected $primaryKey = 'contact_id';
    public $timestamps = false;

    public static function Detail()
    {
        return Self::select('title', 'sub_title', 'address', 'email', 'phone', 'lat', 'long', 'google_map_api_key')
            ->first();
    }

    public static function UpdateContact($param)
    {
        return Self::where('contact_id', 1)
            ->update($param);
    }
}
