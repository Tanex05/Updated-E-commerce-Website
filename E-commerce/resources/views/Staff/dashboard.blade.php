@extends('Staff.layouts.master')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <!-- Existing cards -->
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('order.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-cart-plus"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Todays Orders</h4>
                        </div>
                        <div class="card-body">
                            {{ $todaysOrder }}
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('order.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-cart-plus"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Orders</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalOrders }}
                    </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('pending-orders') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-cart-plus"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pending Orders</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalPendingOrders }}
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('canceled-orders') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-cart-plus"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Canceled Orders</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalCanceledOrders }}
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('delivered-orders') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-cart-plus"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Completed Orders</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalCompleteOrders }}
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Additional cards -->
        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
            <a href="#">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-money-bill-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Todays Earnings</h4>
                        </div>
                        <div class="card-body">
                            ₱{{ number_format($todaysEarnings, 2) }}
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
            <a href="#">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-money-bill-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>This Month Earnings</h4>
                        </div>
                        <div class="card-body">
                            ₱{{ number_format($monthEarnings, 2) }}
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
            <a href="#">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-money-bill-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>This Year Earnings</h4>
                        </div>
                        <div class="card-body">
                            ₱{{ number_format($yearEarnings, 2) }}
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
            <a href="{{ route('reviews.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Reviews</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalReview }}
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
            <a href="{{ route('brand.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-copyright"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Brands</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalBrands }}
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
            <a href="{{ route('category.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-list"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Categories</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalCategories }}
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
            <a href="{{ route('customer.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Users</h4>
                        </div>
                        <div class="card-body">
                            {{$totalUsers}}
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>



@endsection
