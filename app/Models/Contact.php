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
        return Self::select('title','sub_title', 'address', 'email', 'phone', 'lat', 'long')
            ->first();
    }
}
