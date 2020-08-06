<?php

namespace App\Repositories;

use App\Order;// me traigo el modelo de Order

class OrderRepository implements OrderRepositoryInterface
{

    public function create($data)
    {
        $order = new Order($data);
        $order->save();
        $order->products()->attach($data['products']);
        $order->load('products','seller','customer');
        return $order;
    }
}
