<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Validator;

class SubSubCategoryController extends Controller
{
    protected function getRules()
    {
        return [
            'name_en' => 'required|unique:categories',
//            'name_ar' => 'required|unique:categories',
            'sub_category_id' => 'required'
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

    public function SubSubCategoryView()
    {
        $subCategories = SubCategory::latest()->get();
        $subSubCategories = SubSubCategory::with('subCategory')->latest()->get();
        return view('sub_sub_category.category_view', compact('subCategories', 'subSubCategories'));
    }

    public function SubSubCategoryStore(Request $request)
    {
        $rules = $this->getRules();
        $customMSG = $this->getMSG();
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $subCategory = SubSubCategory::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_en,
            'sub_category_id' => $request->sub_category_id
        ]);
        if ($subCategory) {
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

    public function SubSubCategoryEdit($id)
    {
        $subCategories = SubCategory::latest()->get();
        $subSubCategory = SubSubCategory::findOrFail($id);
        return view('sub_sub_category.category_edit', compact('subCategories', 'subSubCategory'));
    }

    public function SubSubCategoryUpdate(Request $request)
    {
        $rules = $this->getRules();
        $customMSG = $this->getMSG();
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $category = SubSubCategory::findOrFail($request->id)->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'sub_category_id' => $request->sub_category_id
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

    public function GetSubSubCategory(Request $request)
    {
        $sub_category_id = $request->sub_category_id;
        $subSubCategories = SubSubCategory::where('sub_category_id', $sub_category_id)->get();
        $data = '';
        foreach ($subSubCategories as $subSubCategory) {
            $data .= '<option value="' . $subSubCategory->id . '">' . $subSubCategory->name_en . ' - ' . $subSubCategory->name_ar . '</option>';
        }
        return $data;
    }
}
