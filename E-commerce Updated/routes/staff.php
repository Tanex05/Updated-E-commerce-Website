<?php

use App\Http\Controllers\Backend\AdminApiController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminListController;
use App\Http\Controllers\Backend\EmployeeListController;
use App\Http\Controllers\Backend\AdminReviewController;
use App\Http\Controllers\Backend\AdvertisementController;
use App\Http\Controllers\Backend\BackgroundImageController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\CustomerListController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\FaqsController;
use App\Http\Controllers\Backend\FlashOutController;
use App\Http\Controllers\Backend\FlashOutImageController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\FlashSaleImageController;
use App\Http\Controllers\Backend\FooterGridThreeController;
use App\Http\Controllers\Backend\FooterGridTwoController;
use App\Http\Controllers\Backend\FooterInfoController;
use App\Http\Controllers\Backend\FooterSocialController;
use App\Http\Controllers\Backend\HomePageSettingController;
use App\Http\Controllers\Backend\ManageUserController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\ShippingRuleController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\StaffController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\TermsAndConditionController;
use App\Http\Controllers\Backend\TransactionController;
use Illuminate\Support\Facades\Route;


/** Admin Route */


/** Employee Route */



/**Staff Profile Route */
Route::group(['middleware' => ['staff'], 'as' => 'staff.'], function(){
    Route::get('/profile/staff', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});

Route::middleware(['staff'])->group(function () {

    /** Staff Route (Admin & Employee) */
    Route::get('staff/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');

    /** Slider Resource */
    Route::put('slider/change-status', [SliderController::class, 'changeStatus'])->name('slider.change-status');
    Route::resource('slider', SliderController::class);

    /** Category Resource */
    Route::put('category/change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
    Route::resource('category', CategoryController::class);

    /** Sub Category Resource */
    Route::put('sub-category/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
    Route::resource('sub-category', SubCategoryController::class);

    /** Child Category Resource */
    Route::put('child-category/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
    Route::get('get-subcategory', [ChildCategoryController::class, 'getSubCategories'])->name('get-subcategories');
    Route::resource('child-category', ChildCategoryController::class);

    /** Brand Resource */
    Route::put('brand/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
    Route::resource('brand', BrandController::class);

    /** Product Resource */
    Route::put('product/change-status', [ProductController::class, 'changeStatus'])->name('product.change-status');
    Route::get('product/sub-category', [ProductController::class, 'getSubCategories'])->name('product-get-subcategories');
    Route::get('product/child-category', [ProductController::class, 'getChildCategories'])->name('product-get-childcategories');
    Route::resource('product', ProductController::class);

    /** ProductImageGallary Resource */
    Route::resource('image-gallery', ProductImageGalleryController::class);

    /** ProductImageVariant Resource */
    Route::put('product-variant/change-status', [ProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
    Route::resource('product-variant', ProductVariantController::class);

    /** ProductImageVariant Item Resource */
    // Did not use a resource route because we are passing two ID, Product ID and Variant ID
    Route::get('product-variant-item/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('product-variant-item.index');
    Route::get('product-variant-item/create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])->name('product-variant-item.create');
    Route::post('product-variant-item', [ProductVariantItemController::class, 'store'])->name('products-variant-item.store');
    Route::get('product-variant-item-edit/{variantItemId}', [ProductVariantItemController::class, 'edit'])->name('product-variant-item.edit');
    Route::put('product-variant-item-update/{variantItemId}', [ProductVariantItemController::class, 'update'])->name('product-variant-item.update');
    Route::delete('product-variant-item/{variantItemId}', [ProductVariantItemController::class, 'destroy'])->name('product-variant-item.destroy');
    Route::put('product-variant-item-status', [ProductVariantItemController::class, 'changeStatus'])->name('product-variant-item.change-status');

    /** Promo Sale Routes */
    Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale.index');
    Route::put('flash-sale', [FlashSaleController::class, 'update'])->name('flash-sale.update');
    Route::post('flash-sale/add-product', [FlashSaleController::class, 'addProduct'])->name('flash-sale.add-product');
    Route::put('flash-sale/show-at-home/status-change', [FlashSaleController::class, 'changeShowAtHomeStatus'])->name('flash-sale.show-at-home.change-status');
    Route::put('flash-sale-status', [FlashSaleController::class, 'changeStatus'])->name('flash-sale-status');
    Route::delete('flash-sale/{id}', [FlashSaleController::class, 'destory'])->name('flash-sale.destory');

    /** Flash Out Routes */
    Route::get('flash-out', [FlashOutController::class, 'index'])->name('flash-out.index');
    Route::post('flash-out/add-product', [FlashOutController::class, 'addProduct'])->name('flash-out.add-product');
    Route::put('flash-out/show-at-home/status-change', [FlashOutController::class, 'changeShowAtHomeStatus'])->name('flash-out.show-at-home.change-status');
    Route::put('flash-out-status', [FlashOutController::class, 'changeStatus'])->name('flash-out-status');
    Route::delete('flash-out/{id}', [FlashOutController::class, 'destory'])->name('flash-out.destory');

    /** Flash Sale And Flash Out */
    Route::get('/get-products-for-dropdown-flashsale', [FlashSaleController::class, 'getProductsForDropdown'])->name('get.products.dropdown-flashsale');
    Route::get('/get-products-for-dropdown-flashout', [FlashSaleController::class, 'getProductsForDropdown'])->name('get.products.dropdown-flashout');

    /** Coupon Routes */
    Route::put('coupons/change-status', [CouponController::class, 'changeStatus'])->name('coupons.change-status');
    Route::resource('coupons', CouponController::class);

    /** Coupon Routes */
    Route::put('shipping-rule/change-status', [ShippingRuleController::class, 'changeStatus'])->name('shipping-rule.change-status');
    Route::resource('shipping-rule', ShippingRuleController::class);

    /** General Setting  Routes */
    Route::resource('faq', FaqsController::class);

    /** Order routes */
    Route::get('payment-status', [OrderController::class, 'changePaymentStatus'])->name('payment.status');
    Route::get('order-status', [OrderController::class, 'changeOrderStatus'])->name('order.status');

    Route::get('pending-orders', [OrderController::class, 'pendingOrders'])->name('pending-orders');
    Route::get('processed-orders', [OrderController::class, 'processedOrders'])->name('processed-orders');

    Route::get('shipped-orders', [OrderController::class, 'shippedOrders'])->name('shipped-orders');
    Route::get('delivered-orders', [OrderController::class, 'deliveredOrders'])->name('delivered-orders');
    Route::get('canceled-orders', [OrderController::class, 'canceledOrders'])->name('canceled-orders');

    Route::resource('order', OrderController::class);

    /** Order Transaction route */
    Route::get('transaction', [TransactionController::class, 'index'])->name('transaction');

    /** Product Slider Routes */
    Route::get('product-slider-one', [HomePageSettingController::class, 'indexOne'])->name('product-slider-one');
    Route::get('product-slider-two', [HomePageSettingController::class, 'indexTwo'])->name('product-slider-two');

    Route::put('product-slider-section-one', [HomePageSettingController::class, 'updateProductSliderSectionOne'])->name('product-slider-section-one');
    Route::put('product-slider-section-two', [HomePageSettingController::class, 'updateProductSliderSectionTwo'])->name('product-slider-section-two');

    /** Product Slider Routes */
    Route::resource('background-images', BackgroundImageController::class);
    Route::resource('background-images-flashsale', FlashSaleImageController::class);
    Route::resource('background-images-flashout', FlashOutImageController::class);

    /** General information */
    Route::resource('Admin-Api', AdminApiController::class);

    /** footer routes */
    Route::resource('footer-info', FooterInfoController::class);
    Route::put('footer-socials/change-status', [FooterSocialController::class, 'changeStatus'])->name('footer-socials.change-status');
    Route::resource('footer-socials', FooterSocialController::class);

    Route::put('footer-grid-two/change-status', [FooterGridTwoController::class, 'changeStatus'])->name('footer-grid-two.change-status');
    Route::put('footer-grid-two/change-title', [FooterGridTwoController::class, 'changeTitle'])->name('footer-grid-two.change-title');
    Route::resource('footer-grid-two', FooterGridTwoController::class);

    Route::put('footer-grid-three/change-status', [FooterGridThreeController::class, 'changeStatus'])->name('footer-grid-three.change-status');
    Route::put('footer-grid-three/change-title', [FooterGridThreeController::class, 'changeTitle'])->name('footer-grid-three.change-title');
    Route::resource('footer-grid-three', FooterGridThreeController::class);


    /** Advertisement Routes */
    Route::get('advertisement', [AdvertisementController::class, 'index'])->name('advertisement.index');
    Route::put('advertisement/homepage-banner-section-one', [AdvertisementController::class, 'homepageBannerSectionOne'])->name('homepage-banner-section-one');
    Route::put('advertisement/homepage-banner-section-two', [AdvertisementController::class, 'homepageBannerSectionTwo'])->name('homepage-banner-section-two');
    Route::put('advertisement/homepage-banner-section-three', [AdvertisementController::class, 'homepageBannerSectionThree'])->name('homepage-banner-section-three');
    Route::put('advertisement/homepage-banner-section-four', [AdvertisementController::class, 'homepageBannerSectionFour'])->name('homepage-banner-section-four');
    Route::put('advertisement/productpage-banner', [AdvertisementController::class, 'productPageBanner'])->name('productpage-banner');
    Route::put('advertisement/cartpage-banner', [AdvertisementController::class, 'cartPageBanner'])->name('cartpage-banner');

    /** reviews routes */
    Route::get('reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
    Route::put('reviews/change-status', [AdminReviewController::class, 'changeStatus'])->name('reviews.change-status');

    /** customer list routes */
    Route::get('customer', [CustomerListController::class, 'index'])->name('customer.index');
    Route::put('customer/status-change', [CustomerListController::class, 'changeStatus'])->name('customer.status-change');

    /** Admin list routes */
    Route::get('employee-list', [EmployeeListController::class, 'index'])->name('employee-list.index');
    Route::put('employee-list/status-change', [EmployeeListController::class, 'changeStatus'])->name('employee-list.status-change');
    Route::delete('employee-list/{id}', [EmployeeListController::class, 'destory'])->name('employee-list.destory');

    /** Admin list routes */
    Route::get('admin-list', [AdminListController::class, 'index'])->name('admin-list.index');
    Route::put('admin-list/status-change', [AdminListController::class, 'changeStatus'])->name('admin-list.status-change');
    Route::delete('admin-list/{id}', [AdminListController::class, 'destory'])->name('admin-list.destory');


    /** manage user routes */
    Route::get('manage-user', [ManageUserController::class, 'index'])->name('manage-user.index');
    Route::post('manage-user', [ManageUserController::class, 'create'])->name('manage-user.create');

    /** about routes */
    Route::get('about', [AboutController::class, 'index'])->name('about.index');
    Route::put('about/update', [AboutController::class, 'update'])->name('about.update');

    /** terms and conditons routes */
    Route::get('terms-and-conditions', [TermsAndConditionController::class, 'index'])->name('terms-and-conditions.index');
    Route::put('terms-and-conditions/update', [TermsAndConditionController::class, 'update'])->name('terms-and-conditions.update');



});


