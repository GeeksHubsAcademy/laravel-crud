<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = ['field_shooting','licensed','user_id'];
    public function user()
    {
       return $this->belongsTo('\App\User');
    }
}
