<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\DeleteProductMail;
use App\Mail\RemoveOrderMail;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Image;

class ProductController extends Controller
{
    protected function getRules()
    {
        return [
            'name_en' => 'required',
//            'name_ar' => 'required',
            'barcode' => 'required|unique:products',
            'quantity' => 'required|numeric|min:0',
            'buy_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            /*'discount_price' => 'numeric|min:0',*/
            'category_id' => 'required',
        ];
    }

    protected function getMSG()
    {
        return [
            'name_en.required' => __('This field is required'),
//            'name_ar.required' => __('This field is required'),
            'barcode.required' => __('This field is required'),
            'barcode.unique' => __('Barcode should be unique'),
            'quantity.required' => __('This field is required'),
            'quantity.numeric' => __('Must be a number'),
            'quantity.min' => __('Must be greater than 0'),
            'buy_price.required' => __('This field is required'),
            'buy_price.numeric' => __('Must be a number'),
            'buy_price.min' => __('Must be grater than 0'),
            'sell_price.required' => __('This field is required'),
            'sell_price.numeric' => __('Must be a number'),
            'sell_price.min' => __('Must be grater than 0'),
            /*'discount_price.numeric' => __('Must be a number'),
            'discount_price.min' => __('Must be grater than 0'),*/
            'category_id.required' => __('This field is required'),
        ];
    }

    public function AddProduct()
    {
        $categories = Category::orderBy('name_en', 'ASC')->get();
        $barcode = Product::latest()->first()->barcode;
        $substr = substr($barcode, -5);
        if ($substr != 00001) {
            $barcode_gen = '0022700001';
        } else {
            $check = (int)substr($barcode, 0, 5);
            if ($check < 227) {
                $barcode_gen = '0022700001';
            } else {
                $int_barcode_gen = $check + 1;
                $barcode_gen = str_pad($int_barcode_gen, 5, "0", STR_PAD_LEFT) . "00001";
            }
        }

        return view('product.product_add', compact('categories', 'barcode_gen'));
    }

    public function barcodegen($id)
    {
        $latest_product = Product::findOrFail($id);
        $barcode = $latest_product->barcode;
        $substr = substr($barcode, -5);
        if ($substr == 00001) {
            $barcode_gen = $barcode;
        } else {
            $barcode_gen = str_pad($barcode, 5, "0", STR_PAD_LEFT) . "00001";
        }
        $barcode_number = (int)substr($barcode_gen, 0, 5);
        $product_name = $latest_product->name_ar;
        $product_price = $latest_product->sell_price;

        /*try {
            $print_data = '^XA
^FO250,40^A0N,70,70^FDLPN^FS
^FO30,120^A0N,50,50
^BCN,100,N,N,N
^FD1000001^SFddddddd^FS
^FO200,300^A0N,50,50
^FD1000001^SFddddddd^FS
^PQ50
^XZ';
            $fp = pfsockopen("127.0.0.1", 9100);
            fputs($fp, $print_data);
            fclose($fp);

            return 'Successfully Printed';
        } catch (\Exception $e) {
            return 'Caught exception: ' . $e->getMessage() . "\n";
        }*/
        return view('barcode.gen_barcode', compact('barcode_gen', 'barcode_number', 'product_name', 'product_price'));
    }

    public function StoreProduct(Request $request)
    {
        $rules = $this->getRules();
        $customMSG = $this->getMSG();
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }


        $product = Product::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_en,
            'barcode' => $request->barcode,
            'quantity' => $request->quantity,
            'buy_price' => $request->buy_price,
            'sell_price' => $request->sell_price,
            'discount_price' => $request->discount_price,
            'category_id' => $request->category_id,
        ]);

        $notification = [
            'message' => __('Product added successfully'),
            'alert-type' => 'success'
        ];

        $id = Product::latest()->first()->id;
        return redirect()->route('barcode', $id);
//        return redirect()->back()->with($notification);
    }

    public function ManageProduct()
    {
        $products = Product::latest()->get();
        return view('product.product_view', compact('products'));
    }

    public function EditProduct($id)
    {
        $categories = Category::orderBy('name_en', 'asc')->get();
        $product = Product::with('category')->findOrFail($id);

        return view('product.product_edit', compact('product', 'categories'));
    }

    public function ProductDataUpdate(Request $request)
    {
        $rules = $this->getRules();
        unset($rules['barcode']);
        $customMSG = $this->getMSG();
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $product = Product::findOrFail($request->id);
        $product->update([
            'name_en' => strtolower($request->name_en),
            'name_ar' => $request->name_ar,
            'barcode' => $request->barcode != null ? $request->barcode : $product->barcode,
            'quantity' => $request->quantity,
            'buy_price' => $request->buy_price,
            'sell_price' => $request->sell_price,
            'discount_price' => $request->discount_price,
            'category_id' => $request->category_id,
        ]);

        $notification = [
            'message' => __('Product updated without updating Images'),
            'alert-type' => 'success'
        ];

        return redirect()->route('manage-product')->with($notification);
    }

    public function ProductDelete($id)
    {
        $product = Product::findOrFail($id);
        $name = $product->name_ar;
        $delete = $product->delete();
        if ($delete) {
            $notification = [
                'message' => __('Product deleted successfully'),
                'alert-type' => 'success'
            ];

            /*if (Auth::user()->role != 'admin') {
                $user = Auth::user()->name;
                $message = " لقد قام " . $user . " بحذف المنتج " . $name;
                $email_data = [
                    'name' => $user,
                    'msg' => $message
                ];

                Mail::to('ahmedalaa123V@gmail.com')->send(new DeleteProductMail($email_data));
            }*/

            return redirect()->back()->with($notification);
        }
        $notification = [
            'message' => __('Can not delete product'),
            'alert-type' => 'error'
        ];
        return redirect()->back()->with($notification);
    }

    public function DeletedProducts()
    {
        $products = Product::onlyTrashed()->latest()->get();
        return view('product.product_deleted', compact('products'));
    }

    public function RestoreProduct($id)
    {
        Product::onlyTrashed()->findOrFail($id)->restore();

        $notification = [
            'message' => __('Product restored successfully'),
            'alert-type' => 'info'
        ];
        return redirect()->route('manage-product')->with($notification);
    }

    public function ProductNotification()
    {
        $products = Product::where('quantity', '<=', 5)->get();
        return view('product.product_view', compact('products'));

    }

    public function GetAllProducts($category_id, $subcategory_id)
    {
        $products = Product::where('category_id', $category_id)->orderBy('name_en', 'ASC')->get();
        return json_encode($products);
    }
}
