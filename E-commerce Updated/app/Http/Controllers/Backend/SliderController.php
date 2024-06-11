<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Cache;

class SliderController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('Staff.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Staff.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner' => ['required','image','max:2000'],
            'type' => ['string','max:200'],
            'title' => ['required','max:200'],
            'sub_description' => ['required','max:200'],
            'btn_url' => ['url'],
            'serial' => ['required','integer'],
            'status' => ['required'],
        ]);

        $slider = new Slider();

        /** Handle file upload*/
        $imagePath = $this->uploadImage($request, 'banner', 'uploads');
        $slider->banner = $imagePath;

        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->sub_description = $request->sub_description;
        $slider->btn_url = $request->btn_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;
        $slider->save();

        toastr('Created Successfully', 'success', 'Success');

        return redirect()->route('slider.index');
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
        $slider = Slider::findOrFail($id);
        return view('Staff.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slider = Slider::findOrFail($id);

        $request->validate([
            'banner' => ['nullable','image','max:2000'],
            'type' => ['string','max:200'],
            'title' => ['required','max:200'],
            'sub_description' => ['required','max:200'],
            'btn_url' => ['url'],
            'serial' => ['required','integer'],
            'status' => ['required'],
        ]);

        /** Handle file upload*/
        $imagePath = $this->updateImage($request, 'banner', 'uploads', $slider->banner);
        $slider->banner = empty(!$imagePath) ? $imagePath : $slider->banner;

        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->sub_description = $request->sub_description;
        $slider->btn_url = $request->btn_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;
        $slider->save();

        Cache::forget('sliders');

        toastr('Edited Banner Successfully', 'success', 'Success');

        return redirect()->route('slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);
        $this->deleteImage($slider->banner);
        $slider->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully']);
    }

    public function changeStatus(Request $request)
    {
        $category = Slider::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        return response(['message' => 'Status has been updated!']);
    }
}
