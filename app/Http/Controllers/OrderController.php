<?php

namespace App\Http\Controllers;

use App\Notifications\OrderCreated;
use App\Order;
use App\Providers\OrderService;
use App\Repositories\OrderServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    private $OrderService;
    public function __construct(OrderService $OrderService)
    {
        $this->OrderService = $OrderService;
    }
    public function create(Request $request)
    {
        $data = $request->only('products', 'seller_id', 'address');
        $validation = Validator::make($data, [
            'products' => 'array|required',
            'seller_id' => 'integer|required',
            'address' => 'required|string'
        ]);
        if ($validation->fails()) {
            return response()->json(['message' => 'There was a problem trying to create the order', 'errors' => $validation->errors()], 400);
        }
        $this->OrderService->createOrderAndNotifyUser($data);
        return response()->json(['order' => $order], 201);
    }
}
