<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoryDataTable;
use App\Models\HomePageSetting;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\Product;
use Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('Staff.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Staff.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => ['required','not_in:empty'],
            'name' => ['string','max:200','unique:categories,name'],
            'status' => ['required','integer'],
        ]);

        $category = new Category();

        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;
        $category->save();

        toastr('Created Successfully', 'success', 'Success');

        return redirect()->route('category.index');
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
        $category = Category::findOrFail($id);
        return view('Staff.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => ['required','not_in:empty'],
            'name' => ['required','string','max:200','unique:categories,name,'.$id],
            'status' => ['required','integer']
        ]);

        $category = Category::findOrFail($id);
        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;
        $category->save();

        toastr('Updated Successfully', 'success', 'Success');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        
        // Check if the category ID exists in any HomePageSetting record
        $homepageSettings = HomePageSetting::where('value', 'like', '%"category":"'.$category->id.'"%')->first();
        if ($homepageSettings) {
            return response(['status' => 'error', 'message' => 'This category is set in homepage settings. Remove it from homepage settings before deleting the category.']);
        }
        
        // Check if the category has any associated subcategories
        $subCategoriesCount = SubCategory::where('category_id', $category->id)->count();
        if ($subCategoriesCount > 0) {
            return response(['status' => 'error', 'message' => 'This category contains subcategories. Delete the associated subcategories first before deleting the category.']);
        }
    
        // Check if the category has any associated products
        $productsCount = Product::where('category_id', $category->id)->count();
        if ($productsCount > 0) {
            return response(['status' => 'error', 'message' => 'This category contains products. Delete the associated products first before deleting the category.']);
        }
    
        // If no associated products, delete the category
        $category->delete();
    
        return response(['status' => 'success', 'message' => 'Category deleted successfully']);
    }

    public function changeStatus(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        return response(['message' => 'Status has been updated!']);
    }
}
