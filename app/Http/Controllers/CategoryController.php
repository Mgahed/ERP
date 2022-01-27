<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    protected function getRules()
    {
        return [
            'name_en' => 'required|unique:categories',
//            'name_ar' => 'required|unique:categories',
        ];
    }

    protected function getMSG()
    {
        return [
            'name_en.required' => __('Must enter the name'),
            'name_ar.required' => __('Must enter the name'),
            'name_en.unique' => __('Name should be unique'),
            'name_ar.unique' => __('Name should be unique')
        ];
    }

    public function CategoryView()
    {
        $category = Category::latest()->get();
        return view('category.category_view', compact('category'));
    }

    public function CategoryStore(Request $request)
    {
        $rules = $this->getRules();
        $customMSG = $this->getMSG();
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $category = Category::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_en
        ]);
        if ($category) {
            $notification = array(
                'message' => __('Category added successfully'),
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
        $notification = array(
            'message' => __('Can not added category'),
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    public function CategoryEdit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.category_edit', compact('category'));
    }

    public function CategoryUpdate(Request $request)
    {
        $rules = $this->getRules();
        $customMSG = $this->getMSG();
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $id = $request->id;

        Category::findOrFail($id)->update([
            'name_en' => strtolower($request->name_en),
            'name_ar' => $request->name_ar
        ]);

        $notification = [
            'message' => __('Category update successfully'),
            'alert-type' => 'success'
        ];

        return redirect()->route('all.category')->with($notification);
    }

    public function CategoryDelete($id)
    {
        Category::findOrFail($id)->delete();

        $notification = [
            'message' => __('Category deleted successfully'),
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
