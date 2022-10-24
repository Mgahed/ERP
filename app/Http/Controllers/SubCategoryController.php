<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Validator;

class SubCategoryController extends Controller
{
    protected function getRules()
    {
        return [
            'name_en' => 'required|unique:categories',
//            'name_ar' => 'required|unique:categories',
            'category_id' => 'required'
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

    public function SubCategoryView()
    {
        $categories = Category::latest()->get();
        $subcategories = SubCategory::with('category')->latest()->get();
        return view('sub_category.category_view', compact('subcategories', 'categories'));
    }

    public function SubCategoryStore(Request $request)
    {
        $rules = $this->getRules();
        $customMSG = $this->getMSG();
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $category = SubCategory::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_en,
            'category_id' => $request->category_id
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

    public function SubCategoryEdit($id)
    {
        $categories = Category::latest()->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('sub_category.category_edit', compact('subcategory', 'categories'));
    }

    public function SubCategoryUpdate(Request $request)
    {
        $rules = $this->getRules();
        $customMSG = $this->getMSG();
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $category = SubCategory::findOrFail($request->id)->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'category_id' => $request->category_id
        ]);
        if ($category) {
            $notification = array(
                'message' => __('Subcategory updated successfully'),
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
        $notification = array(
            'message' => __('Can not updated subcategory'),
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    public function GetSubCategory(Request $request)
    {
        $category_id = $request->category_id;
        $subcategories = SubCategory::where('category_id', $category_id)->get();
        $data = '';
        foreach ($subcategories as $subcategory) {
            $data .= '<option value="' . $subcategory->id . '">' . $subcategory->name_en . ' - ' . $subcategory->name_ar . '</option>';
        }
        return $data;
    }
}
