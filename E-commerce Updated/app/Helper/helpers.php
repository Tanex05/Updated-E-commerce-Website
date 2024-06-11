<?php

use Illuminate\Support\Facades\Session;

/** Set Sidebar item active */

function setActive(array $route){
    if(is_array($route)){
        foreach($route as $r){
            if(request()->routeIs($r)){
                return 'active';
            }
        }
    }
}

/** Check if product have discount */

function checkDiscount($product) {
    $currentDate = date('Y-m-d');

    if($product->offer_price > 0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date) {
        return true;
    }

    return false;
}

/** Calculate discount percent */

function calculateDiscountPercent($originalPrice, $discountPrice) {
    $discountAmount = $originalPrice - $discountPrice;
    $discountPercent = ($discountAmount / $originalPrice) * 100;

    return round($discountPercent);
}


/** Check the product type */

function productType($type)
{
    switch ($type) {
        case 'new_arrival':
            return 'New';

        case 'featured_product':
            return 'Featured';

        case 'top_product':
            return 'Top';

        case 'promo_product':
            return 'Promo';

        case 'flashout_product':
            return 'Flash Out';

        default:
            return '';
    }
}


/** get total cart amount */

function getCartTotal(){
    $total = 0.00;
    foreach(\Cart::content() as $product){
        $total += ($product->price + $product->options->variants_total) * $product->qty;
    }
    return $total;
}

/** get payable total amount */
function getMainCartTotal(){
    if(Session::has('coupon')){
        $coupon = Session::get('coupon');
        $subTotal = getCartTotal();
        if($coupon['discount_type'] === 'amount'){
            $total = $subTotal - $coupon['discount'];
            return $total;
        }elseif($coupon['discount_type'] === 'percent'){
            $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
            $total = $subTotal - $discount;
            return $total;
        }
    }else {
        return getCartTotal();
    }
}

/** get cart discount */
function getCartDiscount(){
    if(Session::has('coupon')){
        $coupon = Session::get('coupon');
        $subTotal = getCartTotal();
        if($coupon['discount_type'] === 'amount'){
            return $coupon['discount'];
        }elseif($coupon['discount_type'] === 'percent'){
            $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
            return $discount;
        }
    }else {
        return 0.00;
    }
}

/** get selected shipping fee from session */
function getShippingFee(){
    if(Session::has('shipping_method')){
        return Session::get('shipping_method')['cost'];
    }else {
        return 0.00;
    }
}

/** get payable amount */
function getFinalPayableAmount(){
    return  getMainCartTotal() + getShippingFee();
}

/** lemit text */

function limitText($text, $limit = 20)
{
    return \Str::limit($text, $limit);
}


