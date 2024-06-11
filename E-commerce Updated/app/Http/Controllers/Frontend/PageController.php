<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\FooterInfo;
use App\Models\TermsAndCondition;
use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function about()
    {
        $about = About::first();
        return view('frontend.pages.about', compact('about'));
    }

    public function termsAndCondition()
    {
        $terms = TermsAndCondition::first();
        return view('frontend.pages.terms-and-condition', compact('terms'));
    }

    public function contact()
    {
        $settings = FooterInfo::first();
        return view('frontend.pages.contact',compact('settings'));
    }

}
