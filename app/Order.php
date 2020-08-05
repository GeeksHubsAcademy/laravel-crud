<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['seller_id', 'customer_id', 'status', 'address'];

    public function seller()
    {
        return $this->belongsTo('\App\User', 'seller_id', 'id', 'users');
    }
    public function customer()
    {
        return $this->belongsTo('\App\User', 'customer_id', 'id', 'users');
    }
    public function products()
    {
        return $this->belongsToMany('\App\Product')->withPivot('quantity');
    }
}
// $order->load('customer','seller','products')
