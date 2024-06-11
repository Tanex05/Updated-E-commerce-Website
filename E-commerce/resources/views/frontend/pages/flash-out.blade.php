@extends('frontend.layouts.master')

@section('content')
    <!--============================
            BREADCRUMB START
        ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Flash Out</h4>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><a href="javascript:;">Flash Out</a></li>
                        </ul>
                    </div>
                </div>
        </div>
        </div>
    </section>
    <!--============================
            BREADCRUMB END
        ==============================-->


    <!--============================
            DAILY DEALS DETAILS START
        ==============================-->
    <section id="wsus__daily_deals">
        <div class="container">
            <div class="wsus__offer_details_area">
                <div class="row">

                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__section_header rounded-0">
                            <h3>Flash Out</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @php
                        $products = \App\Models\Product::withAvg('reviews', 'rating')->withCount('reviews')->with(['variants', 'category', 'productImageGalleries'])->whereIn('id', $flashOutItems)->get();
                    @endphp
                    @forelse ($products as $product)
                    <x-product-card :product="$product" />
                    @empty
                        <div class="col-12 text-center mt-5 mb-5">
                            <p class="lead">There is no Flash Out Item.</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </section>
    <!--============================
            DAILY DEALS DETAILS END
        ==============================-->

@endsection
