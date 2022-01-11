<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addCart(Request $request)
    {
//        return Cart::content();
        $product = Product::where('barcode', $request->barcode)->first();
        if (!$product) {
            $notification = [
                'message' => __('No product with this barcode'),
                'alert-type' => 'error',
                'notbeep' => true,
            ];
            return redirect()->back()->with($notification);
        }
        if ($request->quantity > $product->quantity) {
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
}
