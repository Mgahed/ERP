<?php

namespace App\Http\Controllers;

use App\Mail\DeleteProductMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Retorn;
use App\Models\RetornItem;
use Carbon\Carbon;
use \Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ReturnController extends Controller
{
    public function AllReturns()
    {
        if (url()->previous() != url()->current()) {
            Cart::destroy();
        }
        return view('returns.make');
    }

    public function ViewReturns()
    {
        $returns = Retorn::latest()->get();
        return view('returns.all', compact('returns'));
    }

    public function ViewReturn($id)
    {
        $returns = Retorn::with(['returnItem.product' => function ($q) {
            $q->withTrashed();
        }])->with('user')->with('customer')->findOrFail($id);
        return view('returns.return', compact('returns'));
    }

    public function DeleteReturn($id)
    {
        $return = Retorn::with('returnItem.product')->findOrFail($id);
        $items = $return->toArray();
//        return $return;
        foreach ($items['return_item'] as $item) {
            Product::where('id', $item['product']['id'])->update(['quantity' => DB::raw('quantity-' . $item['qty'])]);
        }
        RetornItem::where('return_id', $id)->delete();
        $delete = $return->delete();
        if ($delete) {
            $notification = [
                'message' => __('Deleted successfully'),
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);
        }
        $notification = [
            'message' => __('Can not delete product'),
            'alert-type' => 'error'
        ];
        return redirect()->back()->with($notification);
    }

    public function PrintReturn($id)
    {
        $return = Retorn::with(['returnItem.product' => function ($q) {
            $q->withTrashed();
        }])->with('user')->with('customer')->findOrFail($id);
        return view('returns.print', compact('return'));
    }

    public function PrintReturnEN($id)
    {
        $return = Retorn::with(['returnItem.product' => function ($q) {
            $q->withTrashed();
        }])->with('user')->with('customer')->findOrFail($id);
        return view('returns.print_en', compact('return'));
    }

    public function MakeReturns(Request $request)
    {
//        return $request;
        $carts = Cart::content();

        $last_return = Retorn::latest()->first();
        if ($last_return) {
            $id = $last_return->id + 1;
        } else {
            $id = 1;
        }

        if ($id < 200000000) {
            $id += 200000000;
        }
        $number = str_pad($id, 9, "0", STR_PAD_LEFT);

        $return_id = Retorn::insertGetId([
            'user_id' => auth()->id(),
            'customer_id' => $request->customer_id,

            'amount' => $request->payed,

            'return_number' => $number,
            'order_date' => $request->order_date,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        foreach ($carts as $cart) {
            Product::where('id', $cart->id)->update(['quantity' => DB::raw('quantity+' . $cart->qty)]);
            RetornItem::create([
                'return_id' => $return_id,
                'product_id' => $cart->id,
                'qty' => $cart->qty,
            ]);
        }

        Cart::destroy();

        if (Session::has('order_page_data')) {
            Session::forget('order_page_data');
        }

        return redirect()->route('view-return', $return_id);
    }
}
