<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\FlashOutController;
use App\Http\Controllers\Backend\StaffController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProductTrackController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserOrderController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('flash-sale/page', [FlashSaleController::class, 'index'])->name('flash-sale');
Route::get('flash-out/page', [FlashOutController::class,'index'])->name('flashout');

/** Product route */
Route::get('products/search', [FrontendProductController::class, 'productsIndex'])->name('products.front.index');
Route::get('product-detail/{slug}', [FrontendProductController::class, 'showProduct'])->name('product-detail');
Route::get('change-product-list-view', [FrontendProductController::class, 'chageListView'])->name('change-product-list-view');

/** Cart routes */
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('cart-details', [CartController::class, 'cartDetails'])->name('cart-details');
Route::post('cart/update-quantity', [CartController::class, 'updateProductQty'])->name('cart.update-quantity');
Route::get('clear-cart', [CartController::class, 'clearCart'])->name('clear.cart');
Route::get('cart/remove-product/{rowId}', [CartController::class, 'removeProduct'])->name('cart.remove-product');
Route::get('cart-count', [CartController::class, 'getCartCount'])->name('cart-count');
Route::get('cart-products', [CartController::class, 'getCartProducts'])->name('cart-products');
Route::post('cart/remove-sidebar-product', [CartController::class, 'removeSidebarProduct'])->name('cart.remove-sidebar-product');
Route::get('cart/sidebar-product-total', [CartController::class, 'cartTotal'])->name('cart.sidebar-product-total');

/** Apply Coupon */
Route::get('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');
Route::get('coupon-calculation', [CartController::class, 'couponCalculation'])->name('coupon-calculation');

/** add product in wishlist */
Route::get('wishlist/add-product', [WishlistController::class, 'addToWishlist'])->name('wishlist.store');

/** about page route */
Route::get('about-us-page', [PageController::class, 'about'])->name('aboutus-page');

/** terms and conditions page route */
Route::get('terms-and-conditions-page', [PageController::class, 'termsAndCondition'])->name('terms-and-conditions-page');

/** contact route */
Route::get('contact', [PageController::class, 'contact'])->name('contact');
Route::post('contact', [PageController::class, 'handleContactForm'])->name('handle-contact-form');

/** Product track route */
Route::get('product-traking', [ProductTrackController::class, 'index'])->name('product-traking.index');


/** User Routes */
Route::group(['middleware'=> ['auth', 'verified'] , 'prefix' => 'user', 'as' => 'user.'] , function(){
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile', [UserProfileController::class, 'updatePassword'])->name('profile.password');

    /** User Address Routes */
    Route::resource('address', UserAddressController::class);

    /** Order Routes */
    Route::get('dashboard/orders', [UserOrderController::class, 'index'])->name('dashboard.orders.index');
    Route::get('dashboard/orders/show/{id}', [UserOrderController::class, 'show'])->name('dashboard.orders.show');

    /** Checkout routes */
    Route::get('checkout', [CheckOutController::class, 'index'])->middleware('NotEmpty')->name('checkout');
    Route::post('checkout/address-create', [CheckOutController::class, 'createAddress'])->name('checkout.address.create');
    Route::post('checkout/form-submit', [CheckOutController::class, 'checkOutFormSubmit'])->name('checkout.form-submit');

    /** Payment Routes */
    Route::get('payment', [PaymentController::class, 'index'])->middleware('NotEmpty')->name('payment');

    /** Paymongo routes */
    Route::post('paymongo/payment',[PaymentController::class, 'payWithPaymongo'])->name('paymongo.payment');
    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('payment-failed', [PaymentController::class, 'paymentFailed'])->name('payment.failed');

    /** COD routes */
    Route::get('cod/payment', [PaymentController::class, 'payWithCod'])->name('cod.payment');
    Route::get('order-success', [PaymentController::class, 'OrderSuccess'])->name('order.success');


    /** Wishlist routes */
    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::get('wishlist/remove-product/{id}', [WishlistController::class, 'destory'])->name('wishlist.destory');

    /** Review routes */
    Route::post('review', [ReviewController::class, 'create'])->name('review.create');


});

