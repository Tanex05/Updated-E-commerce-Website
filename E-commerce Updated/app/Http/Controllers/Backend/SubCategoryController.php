<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use App\Models\HomePageSetting;
use Illuminate\Http\Request;
use Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('Staff.sub-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('Staff.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => ['required'],
            'name' => ['required','string','max:200','unique:sub_categories,name'],
            'status' => ['required','integer']
        ]);

        $subCategory = new SubCategory();

        $subCategory->category_id = $request->category;
        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->status = $request->status;
        $subCategory->save();

        toastr('Created Successfully', 'success', 'Success');
        return redirect()->route('sub-category.index');
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
        $subCategory = SubCategory::findOrFail($id);
        $categories = Category::all();
        return view('Staff.sub-category.edit', compact('subCategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subCategory = SubCategory::findOrFail($id);

        $request->validate([
            'category' => ['required'],
            'name' => ['required','string','max:200','unique:sub_categories,name,'.$id],
            'status' => ['required','integer']
        ]);

        $subCategory->category_id = $request->category;
        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->status = $request->status;
        $subCategory->save();

        toastr('Updated Successfully', 'success', 'Success');
        return redirect()->route('sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        
        // Check if the subcategory ID exists in any HomePageSetting record
        $homepageSettings = HomePageSetting::where('value', 'like', '%"sub_category":"'.$subCategory->id.'"%')->first();
        if ($homepageSettings) {
            return response(['status' => 'error', 'message' => 'This subcategory is set in homepage settings. Remove it from homepage settings before deleting the subcategory.']);
        }
        
        $childCategory = ChildCategory::where('sub_category_id', $subCategory->id)->count();
        if($childCategory > 0){
            return response(['status' => 'error', 'message' => 'This Sub category contains child categories. In order to delete this, you have to delete the child category first!']);
        }
        $subCategory->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully']);
    }

    public function changeStatus(Request $request)
    {
        $subCategory = SubCategory::findOrFail($request->id);
        $subCategory->status = $request->status == 'true' ? 1 : 0;
        $subCategory->save();

        return response(['message' => 'Status has been updated!']);
    }
}
