<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashOutItem;
use Illuminate\Http\Request;

class FlashOutController extends Controller
{
    public function index()
    {
        $flashOutItems = FlashOutItem::where('status', 1)->orderBy('id', 'ASC')->pluck('product_id')->toArray();
        return view('frontend.pages.flash-out', compact('flashOutItems'));
    }
}
