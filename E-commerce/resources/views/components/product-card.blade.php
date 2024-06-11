<div class="col-xl-3 col-sm-6 col-lg-4 {{ @$key }}">
    <div class="wsus__product_item">
        @if(!empty($product->product_type))
            @php
                $background_color = '';
                switch($product->product_type) {
                    case 'new_arrival':
                        $background_color = '#ffcc00'; // yellow
                        break;
                    case 'featured_product':
                        $background_color = '#ff6666'; // pink
                        break;
                    case 'top_product':
                        $background_color = '#66ccff'; // light blue
                        break;
                    case 'promo_product':
                        $background_color = '#FF0000'; // light green
                        break;
                    case 'flashout_product':
                        $background_color = '#ff9900'; // orange
                        break;
                    default:
                        // default background color
                        $background_color = 'none';
                }
            @endphp
            <span class="wsus__new" style="background-color: {{ $background_color }};">{{ productType($product->product_type) }}</span>
        @endif

        @if(checkDiscount($product))
            <span class="wsus__minus">-{{calculateDiscountPercent($product->price, $product->offer_price)}}%</span>
        @endif

        <a class="wsus__pro_link" href="{{route('product-detail', $product->slug)}}">
            <img src="{{asset($product->thumbnail_image)}}" alt="product" class="img-fluid w-100 img_1" />
            <img src="
            @if(isset($product->productImageGalleries[0]->image))
                {{asset($product->productImageGalleries[0]->image)}}
            @else
                {{asset($product->thumbnail_image)}}
            @endif
            " alt="product" class="img-fluid w-100 img_2" style="height: auto;">
            <!-- Fix: Set height to auto to preserve aspect ratio -->
        </a>
        <ul class="wsus__single_pro_icon">
            {{-- Add to Wishlist --}}
            <li><a href="" class="add_to_wishlist" data-id="{{$product->id}}"><i class="far fa-heart"></i></a></li>
        </ul>
        <div class="wsus__product_details">
            <a class="wsus__category" href="#">{{$product->category->name}} </a>

            <p class="wsus__pro_rating">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $product->reviews_avg_rating)
                    <i class="fas fa-star"></i>
                    @else
                    <i class="far fa-star"></i>
                    @endif
                @endfor
                <span>({{$product->reviews_count}} review)</span>
            </p>

            <a class="wsus__pro_name mb-2" href="{{route('product-detail', $product->slug)}}">{{limitText($product->name, 52)}}</a>

            @if(checkDiscount($product))
                <p class="wsus__price">₱ {{ number_format((double) $product->offer_price, 2) }} <del>₱ {{ number_format((double) $product->price, 2) }}</del></p>
            @else
                <p class="wsus__price">₱ {{ number_format((double) $product->price, 2) }}</p>
            @endif
            <form class="shopping-cart-form">
                <input type="hidden" name="product_id" value="{{$product->id}}">
                @foreach ($product->variants as $variant)
                @if ($variant->status != 0)
                    <select class="d-none" name="variants_items[]">
                        @foreach ($variant->productVariantItems as $variantItem)
                            @if ($variantItem->status != 0)
                                <option value="{{$variantItem->id}}" {{$variantItem->is_default == 1 ? 'selected' : ''}}>{{$variantItem->name}} (${{$variantItem->price}})</option>
                            @endif
                        @endforeach
                    </select>
                @endif
                @endforeach
                <input class="" name="qty" type="hidden" min="1" max="100" value="1" />
                <button class="add_cart" type="submit">add to cart</button>
            </form>
        </div>
    </div>
</div>
