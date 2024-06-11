<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomePageSetting;
use Illuminate\Http\Request;

class HomePageSettingController extends Controller
{
    public function indexOne()
    {
        $categories = Category::where('status', 1)->get();
        $sliderSectionOne = HomePageSetting::where('key', 'product_slider_section_one')->first();

        return view('Staff.product-slider-one.product-slider-one', compact('categories', 'sliderSectionOne'));

    }

    public function indexTwo()
    {
        $categories = Category::where('status', 1)->get();

        $sliderSectionTwo = HomePageSetting::where('key', 'product_slider_section_two')->first();


        return view('Staff.product-slider-two.product-slider-two', compact('categories','sliderSectionTwo'));

    }

    public function updateProductSliderSectionOne(Request $request)
    {
        $request->validate([
            'category_one' => ['required']
        ], [
            'category_one.required' => 'Category filed is required'
        ]);

        $data = [
                'category' => $request->category_one,
                'sub_category' => $request->sub_category_one,
                'child_category' => $request->child_category_one,
            ];

        HomePageSetting::updateOrCreate(
            [
                'key' => 'product_slider_section_one'
            ],
            [
                'value' => json_encode($data)
            ]
        );

        toastr('Updated successfully!', 'success', 'success');

        return redirect()->back();

    }

    public function updateProductSliderSectionTwo(Request $request)
    {
        $request->validate([
            'category_two' => ['required']
        ], [
            'category_two.required' => 'Category filed is required'
        ]);

        $data = [
                'category' => $request->category_two,
                'sub_category' => $request->sub_category_two,
                'child_category' => $request->child_category_two,
            ];

        HomePageSetting::updateOrCreate(
            [
                'key' => 'product_slider_section_two'
            ],
            [
                'value' => json_encode($data)
            ]
        );

        toastr('Updated successfully!', 'success', 'success');

        return redirect()->back();
    }

}
