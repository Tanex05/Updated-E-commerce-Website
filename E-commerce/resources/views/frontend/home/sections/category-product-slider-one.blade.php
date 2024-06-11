@php
$routeParam = '';
$hasProductsInCategory = false; // Define $hasProductsInCategory here

// Check if $categoryProductSliderSectionOne is not null before decoding it
if ($categoryProductSliderSectionOne !== null) {
    $categoryProductSliderSectionOne = json_decode($categoryProductSliderSectionOne->value);
    $lastKey = [];

    foreach ($categoryProductSliderSectionOne as $key => $category) {
        if ($category === null) {
            break;
        }
        $lastKey = [$key => $category];
    }

    if (array_keys($lastKey)[0] === 'category') {
        $category = \App\Models\Category::find($lastKey['category']);
        $routeParam = 'category';
        $products = \App\Models\Product::withAvg('reviews', 'rating')->withCount('reviews')->with(['variants', 'category', 'productImageGalleries'])
            ->where('category_id', $category->id)->where('status', 1)->orderBy('id', 'DESC')->take(12)->get();
    } elseif (array_keys($lastKey)[0] === 'sub_category') {
        $category = \App\Models\SubCategory::find($lastKey['sub_category']);
        $routeParam = 'subcategory';
        $products = \App\Models\Product::withAvg('reviews', 'rating')->withCount('reviews')->with(['variants', 'category', 'productImageGalleries'])
            ->where('sub_category_id', $category->id)->where('status', 1)->orderBy('id', 'DESC')->take(12)->get();
    } else {
        $category = \App\Models\ChildCategory::find($lastKey['child_category']);
        $routeParam = 'childcategory';
        $products = \App\Models\Product::withAvg('reviews', 'rating')->withCount('reviews')->with(['variants', 'category', 'productImageGalleries'])
            ->where('child_category_id', $category->id)->where('status', 1)->orderBy('id', 'DESC')->take(12)->get();
    }

    // Check if $categoryProductSliderSectionOne is not null before using it in the loop
    foreach ($products as $product) {
        if ($product->category_id == $category->id || $product->sub_category_id == $category->id || $product->child_category_id == $category->id) {
            $hasProductsInCategory = true;
            break;
        }
    }
}
@endphp

@if ($hasProductsInCategory)
<section id="wsus__electronic">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header">
                    <h3>{{$category->name}}</h3>

                    <a class="see_btn" href="{{ route('products.front.index', [$routeParam => $category->slug]) }}">see more <i class="fas fa-caret-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
            @foreach ($products as $product)
            @if ($product->category_id == $category->id || $product->sub_category_id == $category->id || $product->child_category_id == $category->id)
            <x-product-card :product="$product" />
            @endif
            @endforeach
        </div>
    </div>
</section>
@endif
