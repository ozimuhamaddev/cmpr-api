<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class News extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'news_id';
    public $timestamps = false;

    public static function Home()
    {
        return Self::select('news_id', 'title', 'description', 'image_ori', 'image', 'tag', 'category_name', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->join('category', 'news.category_id', 'category.category_id')
            ->where('active', 'Y')
            ->orderBy('sort', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'ASC')
            ->limit(6)
            ->get();
    }

    public static function Page()
    {
        return Self::select('title', 'description', 'image_ori', 'image', 'icon_id', 'tag', 'category_name', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->join('category', 'news.category_id', 'category.category_id')
            ->where('active', 'Y')
            ->orderBy('sort', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'ASC');
    }

    public static function Detail($news_id)
    {
        return Self::select('title', 'description', 'image_ori', 'image', 'icon_id', 'tag', 'category_name', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->join('category', 'news.category_id', 'category.category_id')
            ->where('news_id', $news_id)
            ->first();
    }

    public static function Other($news_id)
    {
        return Self::select('news_id', 'title', 'image_ori', 'image', 'tag', 'category_name', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->join('category', 'news.category_id', 'category.category_id')
            ->where('active', 'Y')
            ->where('news_id', '<>', $news_id)
            ->orderBy('sort', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'ASC')
            ->limit(5)
            ->get();
    }

    public static function Tags()
    {
        return DB::table('tag')
            ->select('tag')
            ->limit(6)
            ->get();
    }

    public static function Category()
    {
        return DB::table('category')
            ->select('category_name')
            ->limit(6)
            ->get();
    }
}
