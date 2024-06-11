<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ShippingRule;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Cart;


class CheckOutController extends Controller
{
    public function index()
    {
        // Check if user account is active
        if (Auth::user()->status == 'inactive') {
            toastr("Account has been deactivated by the administrator.", 'warning', 'Warning');
            return redirect()->route('home');
        }
        // Store order products
        foreach (\Cart::content() as $item) {
            $product = Product::find($item->id);
            $cartQuantity = $item->qty;
            $productQuantity = $product->qty;

            // Check if cart quantity exceeds product quantity or if product quantity is 0
            if ($cartQuantity > $productQuantity || $productQuantity == 0) {
                return back()->with('error', 'A product inside the cart has an invalid quantity or is out of stock.');
            }
        }

        // Load addresses and shipping methods for checkout
        $addresses = UserAddress::where('user_id', Auth::user()->id)->get();
        $shippingMethods = ShippingRule::where('status', 1)->get();
        return view('frontend.pages.checkout', compact('addresses', 'shippingMethods'));
    }

    public function createAddress(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'email' => ['required', 'max:200', 'email'],
            'phone' => ['required', 'max:200'],
            'region' => ['required', 'max:200'],
            'province' => ['required', 'max:200'],
            'barangay' => ['required', 'max:200'],
            'city' => ['required', 'max:200'],
            'postal_code' => ['required', 'max:200'],
            'address' => ['required'],
        ]);

        $address = new UserAddress();
        $address->user_id = Auth::user()->id;
        $address->name = $request->name;
        $address->email = $request->email;
        $address->phone = $request->phone;
        $address->region = $request->region;
        $address->province = $request->province;
        $address->barangay = $request->barangay;
        $address->city = $request->city;
        $address->postal_code = $request->postal_code;
        $address->address = $request->address;
        $address->save();

        toastr('Address created successfully!', 'success', 'Success');

        return redirect()->back();

    }

    public function checkOutFormSubmit(Request $request)
    {
       $request->validate([
        'shipping_method_id' => ['required', 'integer'],
        'shipping_address_id' => ['required', 'integer'],
       ]);

       $shippingMethod = ShippingRule::findOrFail($request->shipping_method_id);
       if($shippingMethod){
           Session::put('shipping_method', [
                'id' => $shippingMethod->id,
                'name' => $shippingMethod->name,
                'type' => $shippingMethod->type,
                'cost' => $shippingMethod->cost
           ]);
       }
       $address = UserAddress::findOrFail($request->shipping_address_id)->toArray();
       if($address){
           Session::put('address', $address);
       }

       return response(['status' => 'success', 'redirect_url' => route('user.payment')]);
    }
}
