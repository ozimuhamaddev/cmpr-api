<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class News extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'news_id';
    public $timestamps = false;


    protected $fillable = [
        'title',
        'category_id',
        'tag',
        'short_description',
        'description',
        'image',
        'image_ori',
        'updated_at',
        'created_at'
    ];

    public static function Home()
    {
        return Self::select('news_id', 'title', 'description', 'image_ori', 'image', 'tag', 'category_name', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->join('category', 'news.category_id', 'category.category_id')
            ->where('active', 'Y')
            ->orderBy('news.sort', 'DESC')
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
            ->orderBy('news.sort', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'ASC');
    }

    public static function Detail($news_id)
    {
        return Self::select('news_id', 'title', 'short_description', 'description',  'image_ori', 'image', 'icon_id', 'tag', 'category_name', 'news.category_id', 'created_at', 'created_by', 'updated_at', 'updated_by')
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
            ->orderBy('news.sort', 'DESC')
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
            ->select('category_name', 'category_id')
            ->limit(6)
            ->get();
    }



    public static function CategoryDetail($id)
    {
        return Self::select('news_id', 'title', 'short_description', 'description',  'image_ori', 'image', 'icon_id', 'tag', 'category_name', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->join('category', 'news.category_id', 'category.category_id')
            ->where('active', 'Y')
            ->where('news.category_id', $id)
            ->orderBy('news.sort', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'ASC');
    }

    public static function TagsDetail($id)
    {
        return Self::select('news_id', 'title', 'short_description', 'description',  'image_ori', 'image', 'icon_id', 'tag', 'category_name', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->join('category', 'news.category_id', 'category.category_id')
            ->where('active', 'Y')
            ->where('news.tag', 'LIKE', '%' . $id . '%')
            ->orderBy('news.sort', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'ASC');
    }



    public static function ListAll()
    {
        return Self::select('news_id', 'title', 'short_description', 'description',  'image_ori', 'image', 'icon_id', 'tag', 'category_name', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->join('category', 'news.category_id', 'category.category_id')
            ->where('active', 'Y');
    }

    public static function AddNews($param)
    {
        return Self::create($param);
    }

    public static function UpdateNews($param, $news_id)
    {
        return Self::where('news_id', $news_id)
            ->update($param);
    }
}
