<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $table = 'clients';
    protected $primaryKey = 'clients_id';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'image',
        'image_ori',
        'updated_at',
        'created_at'
    ];
    public static function Home()
    {
        return Self::select('clients_id','title', 'image_ori', 'image', 'created_at', 'updated_at')
            ->where('clients.active', 'Y');
    }

    public static function Detail($clients_id)
    {
        return Self::select('clients_id','title',  'image_ori', 'image', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->where('clients_id', $clients_id)
            ->first();
    }

    public static function AddClients($param)
    {
        return Self::create($param);
    }

    public static function UpdateClients($param, $clients_id)
    {
        return Self::where('clients_id', $clients_id)
            ->update($param);
    }
}
