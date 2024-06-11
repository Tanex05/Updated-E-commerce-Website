<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdminApi; // Import the AdminApi model
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;
use Illuminate\Support\Facades\Log;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function index()
    {
        if(!Session::has('address')){
            return redirect()->route('user.checkout');
        }
        return view('frontend.pages.payment');
    }

    public function paymentSuccess()
    {
        // Check if the session variable indicating successful payment exists and is true
        if (\Session::has('payment_success') && \Session::get('payment_success')) {
            // Proceed with storing the order only if payment was successful
            $sessionID = \Session::get('session_id');

            // Call storeOrder function
            $this->storeOrder('Paymongo', 1, $sessionID);

            // Clear session
            $this->clearSession();

            // Clear session
            \Session::forget('payment_success');
            \Session::forget('session_id');

            return view('frontend.pages.payment-success');
        } else {
            // Redirect the user to the cart details page with an error message
            return redirect()->route('cart-details')->with('error', 'You cannot access this page without completing the payment.');
        }
    }

    //cart-details


    public function paymentFailed()
    {
        // Store a message in the session indicating payment cancellation or expiration
        session()->flash('error', 'Payment was cancelled or has expired. Please try again.');

        return view('frontend.pages.payment');
    }

    public function storeOrder($paymentMethod, $paymentStatus, $transactionId)
    {

        $order = new Order();
        $order->invoice_id  = rand(1, 999999);
        $order->user_id = Auth::user()->id;
        $order->sub_total = getCartTotal();
        $order->amount =  getFinalPayableAmount();
        $order->product_qty = \Cart::content()->count();
        $order->payment_method = $paymentMethod;
        $order->payment_status = $paymentStatus;
        $order->order_address = json_encode(Session::get('address'));
        $order->shipping_method = json_encode(Session::get('shipping_method'));
        $order->coupon = json_encode(Session::get('coupon'));
        $order->order_status = 'pending';
        $order->save();

        // store order products
        foreach(\Cart::content() as $item){
            $product = Product::find($item->id);
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $product->id;
            $orderProduct->product_name = $product->name;
            $orderProduct->variants = json_encode($item->options->variants);
            $orderProduct->variant_total = $item->options->variants_total;
            $orderProduct->unit_price = $item->price;
            $orderProduct->qty = $item->qty;
            $orderProduct->save();

            // update product quantity
            $updatedQty = ($product->qty - $item->qty);
            $product->qty = $updatedQty;
            $product->save();
        }

       // Increment usage Total_used for the coupon if a coupon is applied
        $couponData = Session::get('coupon');
        if (!empty($couponData)) {
            // Extract the coupon code from the coupon data array
            $couponCode = $couponData['coupon_code'];

            // Find the coupon model by code
            $couponModel = Coupon::where('code', $couponCode)->first();

            if ($couponModel) {
                $couponModel->total_used += 1;
                $couponModel->save();
            }
        }

        // Update Coupon Status
        if (!empty($couponData) && isset($couponModel)) {
            if ($couponModel->total_used == $couponModel->quantity) {
                $couponModel->status = 0;
                $couponModel->save();
            }
        }


        // store transaction details
        $transaction = new Transaction();
        $transaction->order_id = $order->id;
        $transaction->transaction_id = $transactionId;
        $transaction->payment_method = $paymentMethod;
        $transaction->amount = getFinalPayableAmount();
        $transaction->save();

    }

    public function clearSession()
    {
        \Cart::destroy();
        Session::forget('address');
        Session::forget('shipping_method');
        Session::forget('coupon');
    }

    public function payWithPaymongo()
    {


        $data = [
            'data' => [
                'attributes' => [
                    'line_items' => [
                        [
                            'currency' => 'PHP',
                            'amount' => getFinalPayableAmount() * 100,
                            'name' => 'Technoblast Product Total',
                            'quantity' => 1,
                        ],
                    ],
                    'payment_method_types' => ['card', 'gcash', 'billease', 'paymaya'],
                    'success_url' => route('user.payment.success'),
                    'cancel_url' => route('user.payment.failed'),
                    'description' => Auth::user()->name
                ]
            ]
        ];



        $adminApi = AdminApi::first();

        if ($adminApi && $adminApi->paymongo_secret_key) {
            $api_key = base64_encode($adminApi->paymongo_secret_key); // Encode the API key
            $headers = [
                'Content-Type: application/json',
                'accept: application/json',
                'Authorization: Basic ' . $api_key, // Use the encoded API key in the Authorization header
            ];

            // Your existing code to make the API call
            $response = Curl::to('https://api.paymongo.com/v1/checkout_sessions')
                ->withHeaders($headers)
                ->withData($data)
                ->asJson()
                ->post();

            // After successful payment, set a session variable indicating successful payment
            \Session::put('payment_success', true);

            // Check if the response contains the necessary properties before accessing them
            if (isset($response->data->id)) {
                \Session::put('session_id', $response->data->id);
            }

            if (isset($response->data->attributes->checkout_url)) {
                return redirect()->to($response->data->attributes->checkout_url);
            }
        } else {
            // Handle case where AdminApi record doesn't exist or paymongo_secret_key is empty
            // For example, you can log an error message or handle the situation accordingly
            Log::error('AdminApi record not found or paymongo_secret_key is empty');
            // Alternatively, you can set a default API key or handle the situation based on your requirements
        }
    }

    /** pay with cod */
    public function payWithCod()
    {
        // Check if address is present in session, if not, redirect to user checkout
        if(!Session::has('address')){
            return redirect()->route('user.checkout');
        }

        // Store order and clear session
        $this->storeOrder('COD', 0, \Str::random(10));
        $this->clearSession();

        // Set the session variable indicating COD payment success
        \Session::put('cod_payment_success', true);

        // Redirect to order success page
        return redirect()->route('user.order.success');
    }


    public function OrderSuccess()
    {
        // Check if the session variable indicating COD payment success exists and is true
        if (\Session::has('cod_payment_success') && \Session::get('cod_payment_success')) {
            // Clear the session variable
            \Session::forget('cod_payment_success');

            // Proceed to the order success page
            return view('frontend.pages.order-success');
        } else {
            // Redirect the user to the appropriate page with an error message
            return redirect()->route('user.checkout')->with('error', 'Please complete the COD payment process.');
        }
    }


}
