<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BackgroundImageFlashSale;
use Illuminate\Http\Request;
use File;

class FlashSaleImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $FlashSalebackgroundImage = BackgroundImageFlashSale::first();

        $route = $FlashSalebackgroundImage ? route('background-images-flashsale.update', ['background_images_flashsale' => $FlashSalebackgroundImage->id]) : route('background-images-flashsale.store');

        return view('Staff.flashsaleimage.index', compact('FlashSalebackgroundImage', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $this->uploadImage($request->file('image'));

        BackgroundImageFlashSale::create(['image_path' => $imagePath]);

        toastr('Created Successfully', 'success', 'Success');


        return redirect()->back();

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $FlashSalebackgroundImage = BackgroundImageFlashSale::first();

        if ($request->hasFile('image')) {
            $oldPath = $FlashSalebackgroundImage ? $FlashSalebackgroundImage->image_path : null;
            $imagePath = $this->uploadImage($request->file('image'), $oldPath);
            if (!$FlashSalebackgroundImage) {
                BackgroundImageFlashSale::create(['image_path' => $imagePath]);
            } else {
                $FlashSalebackgroundImage->update(['image_path' => $imagePath]);
            }
        }

        toastr('Updated Successfully', 'success', 'Success');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function uploadImage($image, $oldPath = null)
    {
        if ($oldPath && File::exists(public_path($oldPath))) {
            // If there's an old image, delete it
            File::delete(public_path($oldPath));
        }

        // Save the uploaded image as JPEG format with the name 'backgroundimage.jpg'
        $image->move(public_path('flashsaleImage'), 'flashsaleImage.jpg');

        // Return the path to the saved image
        return 'flashsaleImage/flashsaleImage.jpg';
    }
}
