<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Str;

class BrandController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTable)
    {
        return $dataTable->render('Staff.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Staff.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo' => ['required','image','max:2000'],
            'name' => ['string','max:200'],
            'is_featured' => ['required'],
            'status' => ['required'],
        ]);

        $brand = new Brand();

        /** Handle file upload*/
        $imagePath = $this->uploadImage($request, 'logo', 'uploads');
        $brand->logo = $imagePath;

        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;
        $brand->save();

        toastr('Created Successfully', 'success', 'Success');

        return redirect()->route('brand.index');
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
        $brand = Brand::findOrFail($id);
        return view('Staff.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::findOrFail($id);

        $request->validate([
            'logo' => ['image','max:2000'],
            'name' => ['string','max:200'],
            'is_featured' => ['required'],
            'status' => ['required'],
        ]);

        /** Handle file upload*/
        $imagePath = $this->updateImage($request, 'logo', 'uploads', $brand->logo);
        $brand->logo = empty(!$imagePath) ? $imagePath : $brand->logo;

        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;
        $brand->save();

        toastr('Edited Brand Successfully', 'success', 'Success');

        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        if(Product::where('brand_id', $brand->id)->count() > 0){
            return response()->json(['status' => 'error', 'message' => "This Brand contains Products. You can't delete it."]);
        }
        $brand->delete();

        return response()->json(['message' => 'Brand has been deleted successfully.']);
    }

    public function changeStatus(Request $request)
    {
        $brand = Brand::findOrFail($request->id);
        $brand->status = $request->status == 'true' ? 1 : 0;
        $brand->save();

        return response(['message' => 'Status has been updated!']);
    }
}
