<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'menu_id';
    public $timestamps = false;

    public static function GetMenu()
    {
        return Self::select('menu_id', 'menu_name', 'link', 'active')->orderBy('sort', 'DESC');
    }

    public static function UpdateStatus($menu_id, $value)
    {
        return Self::where('menu_id', $menu_id)->update($value);
    }


    public static function Detail($menu_id)
    {
        return Self::select('menu_id', 'menu_name', 'link', 'active')->where('menu_id', $menu_id)->orderBy('sort', 'DESC')->first();
    }
}
