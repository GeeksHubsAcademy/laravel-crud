<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    // protected $table ='productos'; //nombre personalizado para la tabla
    protected $fillable = ['name', 'price', 'stock', 'available', 'image_path', 'user_id'];
    // protected $guarded =[];

    public function categories()
    {
        return $this->belongsToMany('\App\Category')->withTimestamps();
    }
    public function seller()
    {
        return $this->belongsTo('\App\User','user_id','id','users');
    }
}
