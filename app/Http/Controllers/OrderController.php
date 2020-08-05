<?php

namespace App\Http\Controllers;

use App\Order;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    private $orderRepository;
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    public function create(Request $request)
    {
        $body = $request->only('products', 'seller_id', 'address');
        $validation = Validator::make($body, [
            'products' => 'array|required',
            'seller_id' => 'integer|required',
            'address' => 'required|string'
        ]);
        if ($validation->fails()) {
            return response()->json(['message' => 'There was a problem trying to create the order', 'errors' => $validation->errors()], 400);
        }
        $body['customer_id'] = $request->user()->id; //lo mismo que el Auth::id() o req.user.id
        $order = $this->orderRepository->create($body);
        return response()->json(['order' => $order], 201);
    }
}
