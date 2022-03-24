<?php

namespace App\Http\Controllers;

use App\Mail\LoginMail;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addCart(Request $request)
    {
        $cart = Cart::content();
        $product = Product::where('barcode', $request->barcode)->first();
        if (!$product) {
            $notification = [
                'message' => __('No product with this barcode'),
                'alert-type' => 'error',
                'notbeep' => true,
            ];
            return redirect()->back()->with($notification);
        }
        $cart_qty = 0;
        foreach ($cart as $item) {
            if ($item->id === $product->id) {
                $cart_qty = $item->qty;
            }
        }
        if ($request->quantity + $cart_qty > $product->quantity) {
            $notification = [
                'message' => __('Quantity not available'),
                'alert-type' => 'error',
                'notbeep' => true,
            ];
            return redirect()->back()->with($notification);
        }

        if ($product->discount_price != null) {
            $discount = $product->sell_price - $product->discount_price;
        } else {
            $discount = 0;
        }
//        return $discount;
        Cart::add([
            'id' => $product->id,
            'name' => $product->name_ar,
            'qty' => $request->quantity,
            'price' => $product->sell_price,
            'weight' => 1,
            'options' => [
                'discount' => $discount,
                'price_of_buy' => $product->buy_price,
                'product_id' => $product->id,
            ],
        ]);

        $notification = [
            'message' => __('Product added'),
            'alert-type' => 'success',
            'beep' => true,
        ];
        return redirect()->back()->with($notification);
    }

    public function removeCart($rowId)
    {
        Cart::remove($rowId);

        $notification = [
            'message' => __('Product removed'),
            'alert-type' => 'info'
        ];
        return redirect()->back()->with($notification);
    }

    public function destroyCart()
    {
        Cart::destroy();

        $notification = [
            'message' => __('All products removed'),
            'alert-type' => 'info'
        ];
        return redirect()->back()->with($notification);
    }

    public function makeOrder(Request $request)
    {
        $carts = \Gloudemans\Shoppingcart\Facades\Cart::content();

        $last_order = Order::orderBy('id', 'DESC')->first();
        if ($last_order) {
            $id = $last_order->id + 1;
        } else {
            $id = 1;
        }

        if ($id < 100000000) {
            $id += 100000000;
        }

        $number = str_pad($id, 9, "0", STR_PAD_LEFT);

        $order_id = Order::insertGetId([
            'user_id' => auth()->id(),
            'customer_id' => $request->customer_id,

            'customer_discount' => $request->customer_discount,

            'amount' => $request->sum,

            'order_number' => $number,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        foreach ($carts as $cart) {
            Product::where('id', $cart->id)->update(['quantity' => DB::raw('quantity-' . $cart->qty)]);
            OrderItem::create([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'price_of_buy' => $cart->options->price_of_buy,
                'discount' => $cart->options->discount,
                'subtotal' => $cart->subtotal,
            ]);
        }

        Cart::destroy();

        if (Session::has('order_page_data')) {
            Session::forget('order_page_data');
        }
        if (Auth::user()->role != 'admin') {
            $user = Auth::user()->name;
            $message = " لقد قام " . $user . " بعمل طلب جديد برقم " . $number;
            $email_data = [
                'name' => $user,
                'msg' => $message
            ];

            Mail::to('ahmedalaa123V@gmail.com')->send(new OrderMail($email_data));
        }

        return redirect()->route('view-order', $order_id);
    }
}
