<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'news_id';
    public $timestamps = false;

    public static function Home()
    {
        return Self::select('title', 'content', 'image_ori', 'image', 'tag', 'category_name', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->join('category', 'news.category_id', 'category.category_id')
            ->where('active', 'Y')
            ->orderBy('sort', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'ASC')
            ->limit(6)
            ->get();
    }
}
