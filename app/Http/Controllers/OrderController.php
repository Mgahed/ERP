<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function AllOrders()
    {
        $orders = Order::orderBy('id', 'DESC')->get();
        return view('order.all', compact('orders'));
    }

    public function ViewOrder($id)
    {
        $order = Order::with(['orderItem.product' => function ($q) {
            $q->withTrashed();
        }])->with('user')->with('customer')->findOrFail($id);
//        return $order;
        return view('order.order', compact('order'));
    }

    public function PrintOrder($id)
    {
        $order = Order::with(['orderItem.product' => function ($q) {
            $q->withTrashed();
        }])->with('user')->with('customer')->findOrFail($id);
        return view('order.print', compact('order'));
    }

    public function RemoveItem($id)
    {
        $item = OrderItem::findOrFail($id);
        $deleted_price = $item->price - $item->discount;
        if ($item->qty <= 1) {
            $item->delete();
        } else {
            $item->update([
                'subtotal' => $item->price * ($item->qty - 1),
                'qty' => DB::raw('qty-1')
            ]);
        }

        Product::findOrFail($item->product_id)->update(['quantity' => DB::raw('quantity+1')]);
        Order::findOrFail($item->order_id)->update(['amount' => DB::raw('amount-' . $deleted_price)]);

        $notification = [
            'message' => __('One item deleted'),
            'alert-type' => 'info'
        ];
        return redirect()->back()->with($notification);
    }

    public function RemoveAllItem($id)
    {
        $item = OrderItem::findOrFail($id);
        $deleted_price = $item->qty * ($item->price - $item->discount);

        $item->delete();

        Product::findOrFail($item->product_id)->update(['quantity' => DB::raw('quantity+' . $item->qty)]);
        Order::findOrFail($item->order_id)->update(['amount' => DB::raw('amount-' . $deleted_price)]);

        $notification = [
            'message' => __('All items deleted'),

            'alert-type' => 'info'
        ];
        return redirect()->back()->with($notification);
    }

    public function DeleteOrder($id)
    {
        $order = Order::findOrFail($id);
        $items = OrderItem::where('order_id', $id)->get();
        foreach ($items as $item) {
            Product::withTrashed()->findOrFail($item->product_id)->update(['quantity' => DB::raw('quantity+' . $item->qty)]);
        }
        $order->delete();

        $notification = [
            'message' => __('Order deleted'),

            'alert-type' => 'info'
        ];
        return redirect()->back()->with($notification);
    }

    public function DeletedOrders()
    {
        $orders = Order::onlyTrashed()->get();
        return view('order.deleted', compact('orders'));
    }

    public function RestoreOrder($id)
    {
        $order = Order::onlyTrashed()->findOrFail($id);
        $items = OrderItem::where('order_id', $id)->get();
        foreach ($items as $item) {
            Product::withTrashed()->findOrFail($item->product_id)->update(['quantity' => DB::raw('quantity-' . $item->qty)]);
        }
        $order->restore();

        $notification = [
            'message' => __('Order restored'),

            'alert-type' => 'info'
        ];
        return redirect()->back()->with($notification);
    }
}
