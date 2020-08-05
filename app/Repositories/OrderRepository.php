<?php

namespace App\Repositories;

use App\Order;// me traigo el modelo de Order

class OrderRepository
{

    public function create($body)
    {
        $order = new Order($body);
        $order->save();
        $order->products()->attach($body['products']);
        $order->load('products','seller','customer');
        return $order;
    }
}
