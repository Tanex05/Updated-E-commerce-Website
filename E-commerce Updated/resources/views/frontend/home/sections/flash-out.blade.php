<section id="wsus__flash_sell" class="wsus__flash_sell_2" style="padding-top: 50px">
    <div class="container">
        @php
            $products = \App\Models\Product::withAvg('reviews', 'rating')
                ->withCount('reviews')
                ->with(['variants', 'category', 'productImageGalleries'])
                ->whereIn('id', $flashOutItems)
                ->get();
        @endphp
        @if($products->isNotEmpty() && $products->contains('status', 1))
            <!-- Show this section if there are items with status equal to 1 -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="offer_time" style="background: url({{ asset('flashoutImage/flashoutImage.jpg') }})">
                        <div class="wsus__flash_coundown" style="padding-top: 4%; padding-bottom: 4%;">
                            <span class="end_text">Flash Out</span>
                            <a class="common_btn" href="{{ route('flashout') }}">see more <i class="fas fa-caret-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row flash_sell_slider">
            <!-- Loop through each product -->
            @foreach ($products as $product)
                <!-- Loop through each FlashOutItem associated with the product -->
                @foreach ($product->flashOutItem as $flashOutItem)
                    <!-- Show product card only if show_at_home is 1 -->
                    @if ($flashOutItem->show_at_home == 1)
                        <x-product-card :product="$product" />
                    @endif
                @endforeach
            @endforeach
        </div>

    </div>
</section>
