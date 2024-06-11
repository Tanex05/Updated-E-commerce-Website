<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Str;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {
        return $dataTable->render('Staff.child-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('Staff.child-category.create', compact(['categories','subCategories']));
    }
    /**
     * Fetch the Sub Category to create child Category.
     */

    public function getSubCategories (Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->id)->where('status', 1)->get();
        return $subCategories;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => ['required'],
            'sub_category' => ['required'],
            'name' => ['required','string','max:200','unique:child_categories,name'],
            'status' => ['required','integer']
        ]);

        $childCategory = new ChildCategory();

        $childCategory->category_id = $request->category;
        $childCategory->sub_category_id = $request->sub_category;
        $childCategory->name = $request->name;
        $childCategory->slug = Str::slug($request->name);
        $childCategory->status = $request->status;
        $childCategory->save();

        toastr('Created Successfully', 'success', 'Success');
        return redirect()->route('child-category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $childCategory = ChildCategory::findOrFail($id);
        $subCategory = SubCategory::where('category_id', $childCategory->category_id)->where('status',1)->get();
        $categories = Category::all();
        return view('Staff.child-category.edit', compact(['childCategory','categories','subCategory']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $childCategory = ChildCategory::findOrFail($id);

        $request->validate([
            'category' => ['required'],
            'sub_category' => ['required'],
            'name' => ['required','string','max:200','unique:child_categories,name,'.$id],
            'status' => ['required','integer']
        ]);

        $childCategory->category_id = $request->category;
        $childCategory->sub_category_id = $request->sub_category;
        $childCategory->name = $request->name;
        $childCategory->slug = Str::slug($request->name);
        $childCategory->status = $request->status;
        $childCategory->save();

        toastr('Updated Successfully', 'success', 'Success');
        return redirect()->route('child-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $childCategory = ChildCategory::findOrFail($id);
        
        // Check if the child category ID exists in any HomePageSetting record
        $homepageSettings = HomePageSetting::where('value', 'like', '%"child_category":"'.$childCategory->id.'"%')->first();
        if ($homepageSettings) {
            return response(['status' => 'error', 'message' => 'This child category is set in homepage settings. Remove it from homepage settings before deleting the child category.']);
        }
    
        if(Product::where('child_category_id', $childCategory->id)->count() > 0){
            return response(['status' => 'error', 'message' => 'This item contain relation can\'t delete it.']);
        }

        $childCategory->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $childCategory = ChildCategory::findOrFail($request->id);
        $childCategory->status = $request->status == 'true' ? 1 : 0;
        $childCategory->save();

        return response(['message' => 'Status has been updated!']);
    }

}
