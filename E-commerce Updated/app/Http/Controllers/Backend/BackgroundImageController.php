<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BackgroundImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BackgroundImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $backgroundImage = BackgroundImage::first();
        $route = $backgroundImage ? route('background-images.update', ['background_image' => $backgroundImage->id]) : route('background-images.store');
        return view('Staff.backgroundimage.index', compact('backgroundImage', 'route'));
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

        BackgroundImage::create(['image_path' => $imagePath]);

        toastr('Created Successfully', 'success', 'Success');

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BackgroundImage $background_image)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($background_image->image_path && File::exists(public_path($background_image->image_path))) {
                File::delete(public_path($background_image->image_path));
            }

            // Save the new image
            $imagePath = $this->uploadImage($request->file('image'));
            $background_image->update(['image_path' => $imagePath]);

            toastr('Updated Successfully', 'success', 'Success');
        } else {
            toastr('Background image not found', 'error', 'Error');
        }

        return redirect()->back();
    }

    private function uploadImage($image, $oldPath = null)
    {
        if ($oldPath && File::exists(public_path($oldPath))) {
            // If there's an old image, delete it
            File::delete(public_path($oldPath));
        }

        // Save the uploaded image as JPEG format with the name 'backgroundimage.jpg'
        $image->move(public_path('backgrounds'), 'backgroundimage.jpg');

        // Return the path to the saved image
        return 'backgrounds/backgroundimage.jpg';
    }
}
