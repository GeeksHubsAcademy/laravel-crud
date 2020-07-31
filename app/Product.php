<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'price', 'stock', 'available','image_path'];
    // protected $guarded =[];

    public function categories()
    {
        return $this->belongsToMany('\App\Category')->withTimestamps();
    }
}
