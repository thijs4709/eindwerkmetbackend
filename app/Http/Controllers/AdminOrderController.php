<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    //
    public function index()
    {
        $orders = Order::paginate();
        return view("admin.orders.index",compact("orders"));
    }
    public function show(Order $order)
    {
        $order->load("orderDetails.box.photo","orderDetails.card.photo");
        $items = $order->orderDetails;
        return view("admin.orders.show",compact("order","items"));
    }
}
