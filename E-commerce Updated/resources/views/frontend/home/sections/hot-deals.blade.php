<section id="wsus__hot_deals" class="wsus__hot_deals_2 mt-4">
    <div class="container">
        <div class="wsus__hot_large_item">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__section_header justify-content-start">
                        <div class="monthly_top_filter2 mb-1">
                            @if (!$typeBaseProducts['new_arrival']->isEmpty())
                                <button class="active auto_click" data-filter=".new_arrival">New Arrival</button>
                            @endif
                            @if (!$typeBaseProducts['featured_product']->isEmpty())
                                <button data-filter=".featured_product">Featured</button>
                            @endif
                            @if (!$typeBaseProducts['top_product']->isEmpty())
                                <button data-filter=".top_product">Top Product</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row grid2">
                @foreach ($typeBaseProducts as $key => $products)
                    @foreach ($products as $product)
                        <x-product-card :product="$product" :key="$key" />
                    @endforeach
                @endforeach
            </div>
        </div>

        <section id="wsus__single_banner" class="home_2_single_banner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        @if (isset($homepage_section_banner_three->banner_one) && isset($homepage_section_banner_three->banner_one->status) && $homepage_section_banner_three->banner_one->status == 1)
                            <div class="wsus__single_banner_content banner_1">
                                <a href="{{ $homepage_section_banner_three->banner_one->banner_url }}">
                                    <img class="lazyload img-fluid" data-src="{{ asset($homepage_section_banner_three->banner_one->banner_image) }}" alt="">
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                @if (isset($homepage_section_banner_three->banner_two) && isset($homepage_section_banner_three->banner_two->status) && $homepage_section_banner_three->banner_two->status == 1)
                                    <div class="wsus__single_banner_content single_banner_2">
                                        <a href="{{ $homepage_section_banner_three->banner_two->banner_url }}">
                                            <img class="lazyload img-fluid" data-src="{{ asset($homepage_section_banner_three->banner_two->banner_image) }}" alt="">
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="col-12 mt-lg-4">
                                <div class="wsus__single_banner_content">
                                    @if (isset($homepage_section_banner_three->banner_three) && isset($homepage_section_banner_three->banner_three->status) && $homepage_section_banner_three->banner_three->status == 1)
                                        <a href="{{ $homepage_section_banner_three->banner_three->banner_url }}">
                                            <img class="lazyload img-fluid" data-src="{{ asset($homepage_section_banner_three->banner_three->banner_image) }}" alt="">
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
