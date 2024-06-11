@extends('frontend.layouts.master')

@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>payment</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li><a href="javascript:;">payment</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->
    @php
        $adminApi = App\Models\AdminApi::first();
        $check = $adminApi && $adminApi->paymongo_secret_key;
    @endphp

    <!--============================
        PAYMENT PAGE START
    ==============================-->
    <section id="wsus__cart_view">
    <div class="container">
        <div class="wsus__pay_info_area">
            <div class="row">
                <div class="col-xl-3 col-lg-3">
                    <div class="wsus__payment_menu" id="sticky_sidebar">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @if ($check)
                            <button class="nav-link common_btn active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-banks-e-wallet" type="button" role="tab" aria-controls="v-pills-banks-e-wallet" aria-selected="true">Bank / E-Wallet</button>
                            @endif
                            <button class="nav-link common_btn" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-cod" type="button" role="tab" aria-controls="v-pills-stripe" aria-selected="false">Cash On Delivery</button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5">
                    <div class="tab-content" id="v-pills-tabContent">
                        @if ($check)
                        <div class="tab-pane fade show active" id="v-pills-banks-e-wallet" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="row justify-content-center">
                                <div class="col-md-12" style="background-color: #fff; padding: 30px; border-radius: 8px;">
                                    <form action="{{ route('user.paymongo.payment') }}" method="POST" id="paymongo_payment_form">
                                        @csrf
                                        <h2 style="text-align: center; margin-bottom: 20px;">Pay with Paymongo</h2>
                                        <p style="text-align: center; color: #666; margin-bottom: 30px;">Make secure payments using Paymongo. We accept various payment methods to provide you with a convenient checkout experience.</p>
                                        <button class="nav-link common_btn text-center" type="submit" style="color: #fff; border: none; padding: 10px 20px; border-radius: 4px; width: 100%; margin-bottom: 20px;">Proceed to Payment</button>
                                        <p style="margin-bottom: 10px;">Accepted Payment Methods:</p>
                                        <ul style="list-style: none; padding: 0; display: flex; flex-wrap: wrap; justify-content: center;">
                                            <li style="margin-right: 20px; display: flex; align-items: center;"><i class="fa fa-credit-card" style="margin-right: 5px;"></i> Credit</li>
                                            <li style="margin-right: 20px; display: flex; align-items: center;"><i class="fa fa-mobile" style="margin-right: 5px;"></i> GCash</li>
                                            <li style="margin-right: 20px; display: flex; align-items: center;"><i class="fa fa-mobile" style="margin-right: 5px;"></i> Maya</li>
                                            <li style="display: flex; align-items: center;"><i class="fa fa-money-bill-alt" style="margin-right: 5px;"></i> BillEase</li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="tab-pane fade" id="v-pills-cod" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="payment-form-wrapper">
                                        <form action="{{ route('user.cod.payment') }}" method="GET" id="cod_payment_form">
                                            @csrf
                                            <h2 class="text-center mb-4">Pay with Cash On Delivery</h2>
                                            <p class="text-center text-muted mb-4">With Cash On Delivery, you can pay for your order with cash when it's delivered to your doorstep. It's a convenient and hassle-free way to shop online.</p>
                                            <button class="nav-link common_btn text-center" type="submit" style="color: #fff; border: none; padding: 10px 20px; border-radius: 4px; width: 100%; margin-bottom: 20px;">Proceed to Payment</button>
                                            <p class="mt-4 mb-2">Please note:</p>
                                            <ul class="list-unstyled text-muted">
                                                <li class="mb-2"> Cash On Delivery is available for eligible orders.</li>
                                                <li class="mb-2"> Make sure to have the exact amount ready at the time of delivery.</li>
                                                <li class="mb-2"> COD orders may be subject to additional verification.</li>
                                                <li class="mb-2"> Please provide valid contact details for smooth delivery.</li>
                                            </ul>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="wsus__pay_booking_summary" id="sticky_sidebar2">
                        <h5>Order Summary</h5>
                        <p>subtotal: <span>₱{{ number_format(getCartTotal(), 2) }}</span></p>
                        <p>shipping fee (+): <span>₱{{ number_format(getShippingFee(), 2) }}</span></p>
                        <p>coupon (-): <span>₱{{ number_format(getCartDiscount(), 2) }}</span></p>
                        <h6>total <span>₱{{ number_format(getFinalPayableAmount(), 2) }}</span></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!--============================
        PAYMENT PAGE END
    ==============================-->
@endsection



