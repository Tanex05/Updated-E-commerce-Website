<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Brand;
use App\Models\FlashOutItem;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $flashSaleDate = FlashSale::first();

        $flashSaleItems = FlashSaleItem::where('show_at_home', 1)->where('status', 1)->pluck('product_id')->toArray();
        $flashOutItems = FlashOutItem::where('show_at_home', 1)->where('status', 1)->pluck('product_id')->toArray();
        $brands = Brand::where('status', 1)->where('is_featured', 1)->get();

        $typeBaseProducts = $this->getTypeBaseProduct();
        $categoryProductSliderSectionOne = HomePageSetting::where('key', 'product_slider_section_one')->first();
        $categoryProductSliderSectionTwo = HomePageSetting::where('key', 'product_slider_section_two')->first();

        // banners
        $homepage_section_banner_one = Advertisement::where('key', 'homepage_section_banner_one')->first();
        $homepage_section_banner_one = json_decode($homepage_section_banner_one?->value);

        $homepage_section_banner_two = Advertisement::where('key', 'homepage_section_banner_two')->first();
        $homepage_section_banner_two = json_decode($homepage_section_banner_two?->value);

        $homepage_section_banner_three = Advertisement::where('key', 'homepage_section_banner_three')->first();
        $homepage_section_banner_three = json_decode($homepage_section_banner_three?->value);

        $homepage_section_banner_four = Advertisement::where('key', 'homepage_section_banner_four')->first();
        $homepage_section_banner_four = json_decode($homepage_section_banner_four?->value);

        $sliders = Slider::where('status', 1)->orderBy('serial', 'asc')->get();

        return view('frontend.home.home',
         compact(
            'sliders',
            'flashSaleDate',
            'flashSaleItems',
            'flashOutItems',
            'brands',
            'typeBaseProducts',
            'categoryProductSliderSectionOne',
            'categoryProductSliderSectionTwo',

            'homepage_section_banner_one',
            'homepage_section_banner_two',
            'homepage_section_banner_three',
            'homepage_section_banner_four',

        ));
    }

    public function getTypeBaseProduct()
    {
        $typeBaseProducts = [];

        $typeBaseProducts['new_arrival'] = Product::withAvg('reviews', 'rating')->withCount('reviews')->with(['variants', 'category', 'productImageGalleries'])
        ->where(['product_type' => 'new_arrival', 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();

        $typeBaseProducts['featured_product'] = Product::withAvg('reviews', 'rating')->withCount('reviews')->with(['variants', 'category', 'productImageGalleries'])
        ->where(['product_type' => 'featured_product', 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();

        $typeBaseProducts['top_product'] = Product::withAvg('reviews', 'rating')->withCount('reviews')->with(['variants', 'category', 'productImageGalleries'])
        ->where(['product_type' => 'top_product', 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();

        return $typeBaseProducts;
    }
}
