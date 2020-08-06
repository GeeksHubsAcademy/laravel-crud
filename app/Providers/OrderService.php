<?php
namespace App\Providers;

use App\Notifications\OrderCreated;
use App\Repositories\OrderRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class OrderService {
    private $orderRepository;
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    public function createOrderAndNotifyUser($data)
    {
        $user = Auth::user();
        $data['customer_id'] = $user->id; //lo mismo que el Auth::id() o req.user.id
        $order = $this->orderRepository->create($data);
        $user->notify(new OrderCreated($order));
    }
}
