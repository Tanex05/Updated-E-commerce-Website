<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BackgroundImageFlashOut;
use Illuminate\Http\Request;
use File;

class FlashOutImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $FlashOutbackgroundImage = BackgroundImageFlashOut::first();

        $route = $FlashOutbackgroundImage ? route('background-images-flashout.update', ['background_images_flashout' => $FlashOutbackgroundImage->id]) : route('background-images-flashout.store');

        return view('Staff.flashoutimage.index', compact('FlashOutbackgroundImage', 'route'));
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

        BackgroundImageFlashOut::create(['image_path' => $imagePath]);

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

        $FlashOutbackgroundImage = BackgroundImageFlashOut::first();

        if ($request->hasFile('image')) {
            $oldPath = $FlashOutbackgroundImage ? $FlashOutbackgroundImage->image_path : null;
            $imagePath = $this->uploadImage($request->file('image'), $oldPath);
            if (!$FlashOutbackgroundImage) {
                BackgroundImageFlashOut::create(['image_path' => $imagePath]);
            } else {
                $FlashOutbackgroundImage->update(['image_path' => $imagePath]);
            }
        }

        toastr('Updated Successfully', 'success', 'Success');

        return redirect()->back();//
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
        $image->move(public_path('flashoutImage'), 'flashoutImage.jpg');

        // Return the path to the saved image
        return 'flashoutImage/flashoutImage.jpg';
    }
}
