 <section id="wsus__flash_sell" class="wsus__flash_sell_2" style="padding-top: 40px">
        <div class="container">

            @php
                // Fetch Flash Out items with related data
                $FlashSale = \App\Models\FlashSaleItem::with(['product.variants', 'product.category', 'product.productImageGalleries'])
                    ->where('status', 1)
                    ->get();
            @endphp

            @if($FlashSale->isNotEmpty() && $FlashSale->contains('status', 1))
                <!-- Show this section if there are items with status equal to 1 -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="offer_time" style="background: url({{ asset('flashsaleImage/flashsaleImage.jpg') }}); background-size: cover; background-position: center;">
                            <div class="wsus__flash_coundown">
                                <span class="end_text">Flash Sale</span>
                                <div class="simply-countdown simply-countdown-one"></div>
                                <a class="common_btn" href="{{ route('flash-sale') }}">see more <i class="fas fa-caret-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row flash_sell_slider">
                @php
                    $products = \App\Models\Product::withAvg('reviews', 'rating')->withCount('reviews')
                    ->with(['variants', 'category', 'productImageGalleries'])->whereIn('id', $flashSaleItems)->get();
                @endphp
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

        </div>
    </section>


    @push('scripts')
    <script>
        $(document).ready(function(){
            @if($flashSaleDate)
                simplyCountdown('.simply-countdown-one', {
                    year: {{date('Y', strtotime($flashSaleDate->end_date))}},
                    month: {{date('m', strtotime($flashSaleDate->end_date))}},
                    day: {{date('d', strtotime($flashSaleDate->end_date))}},
                });
            @endif
        })
    </script>
    @endpush
    
