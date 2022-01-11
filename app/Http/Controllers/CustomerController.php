<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    protected function getRules()
    {
        return [
            'name' => 'required',
            'mobile' => 'required|numeric',
        ];
    }

    protected function getMSG()
    {
        return [
            'name.required' => __('This field is required'),
            'mobile.required' => __('This field is required'),
            'mobile.numeric' => __('Must be a number'),
        ];
    }

    public function CustomerView()
    {
        $customer = Customer::latest()->get();
        return view('customer.customer_view', compact('customer'));
    }

    public function CustomerStore(Request $request)
    {
        $rules = $this->getRules();
        $customMSG = $this->getMSG();
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $customer = Customer::create([
            'name' => $request->name,
            'mobile' => $request->mobile
        ]);
        if ($customer) {
            $notification = array(
                'message' => __('Customer added successfully'),
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
        $notification = array(
            'message' => __('Can not add customer'),
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    public function CustomerEdit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.customer_edit', compact('customer'));
    }

    public function CustomerUpdate(Request $request)
    {
        $rules = $this->getRules();
        $customMSG = $this->getMSG();
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $id = $request->id;

        Customer::findOrFail($id)->update([
            'name' => $request->name,
            'mobile' => $request->mobile
        ]);

        $notification = [
            'message' => __('Customer updated successfully'),
            'alert-type' => 'success'
        ];

        return redirect()->route('all.customers')->with($notification);
    }
}
