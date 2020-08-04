<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $body = $request->all();
        $validation = Validator::make($body, [
            'products' => 'array|required',
            'seller_id' => 'integer|required'
        ]);
        if ($validation->fails()) {
            return response()->json(['message' => 'There was a problem trying to create the order', 'errors' => $validation->errors()], 400);
        }
        $body['customer_id'] = $request->user()->id;//lo mismo que el Auth::id() o req.user.id
        $order = new Order($body);
        $order->save();
        $order->products()->attach($body['products']);
        $order->load('products','seller','customer');
        return response()->json(['order'=>$order],201);
    }
}
