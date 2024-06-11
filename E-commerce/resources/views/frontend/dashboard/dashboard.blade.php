@extends('frontend.dashboard.layouts.master')

@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
        @include('frontend.dashboard.layouts.sidebar')
        <div class="row">
            <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                <h3>User Dashboard</h3>
                <br>
                <div class="dashboard_content">
                    <div class="wsus__dashboard">
                        <div class="row">
                            <div class="col">
                                <a class="wsus__dashboard_item red" href="{{ route('user.dashboard.orders.index') }}">
                                    <i class="fas fa-cart-plus"></i>
                                    <p>Total Order</p>
                                    <h4 style="color:#ffff">{{ $totalOrder }}</h4>
                                </a>
                            </div>
                            <div class="col">
                                <a class="wsus__dashboard_item green" href="{{ route('user.dashboard.orders.index') }}">
                                    <i class="fas fa-cart-plus"></i>
                                    <p>Pending Orders</p>
                                    <h4 style="color:#ffff">{{ $pendingOrder }}</h4>
                                </a>
                            </div>
                            <div class="col">
                                <a class="wsus__dashboard_item sky" href="{{ route('user.dashboard.orders.index') }}">
                                    <i class="fas fa-cart-plus"></i>
                                    <p>Completed Orders</p>
                                    <h4 style="color:#ffff">{{ $completeOrder }}</h4>
                                </a>
                            </div>
                            <div class="col">
                                <a class="wsus__dashboard_item purple" href="{{ route('user.wishlist.index') }}">
                                    <i class="fa fa-heart"></i>
                                    <p>Wishlist</p>
                                    <h4 style="color:#ffff">{{ $wishlist }}</h4>
                                </a>
                            </div>
                            <div class="col">
                                <a class="wsus__dashboard_item orange" href="{{ route('user.profile') }}">
                                    <i class="fas fa-user-shield"></i>
                                    <p>Profile</p>
                                    <h4 style="color:#ffff">-</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
