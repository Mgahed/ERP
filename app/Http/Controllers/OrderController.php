<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function AllOrders()
    {
        $orders = Order::orderBy('id','DESC')->get();
        return view('order.all',compact('orders'));
    }

    public function ViewOrder($id)
    {
        $order = Order::with('orderItem.product')->with('user')->with('customer')->findOrFail($id);
//        return $order;
        return view('order.order',compact('order'));
    }

    public function PrintOrder($id)
    {
        $order = Order::with('orderItem.product')->with('user')->with('customer')->findOrFail($id);
        return view('order.print',compact('order'));
    }
}
