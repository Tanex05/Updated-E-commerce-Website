<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Support\Carbon;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function dashboard()
    {
        $todaysOrder = Order::whereDate('created_at', Carbon::today())->count();
        $todaysPendingOrder = Order::whereDate('created_at', Carbon::today())
        ->where('order_status', 'pending')->count();
        $totalOrders = Order::count();
        $totalPendingOrders = Order::where('order_status', 'pending')->count();
        $totalCanceledOrders = Order::where('order_status', 'canceled')->count();
        $totalCompleteOrders = Order::where('order_status', 'delivered')->count();

        $todaysEarnings = Order::where('order_status','!=', 'canceled')
        ->where('payment_status',1)
        ->whereDate('created_at', Carbon::today())
        ->sum('sub_total');

        $monthEarnings = Order::where('order_status','!=', 'canceled')
        ->where('payment_status',1)
        ->whereMonth('created_at', Carbon::now()->month)
        ->sum('sub_total');

        $yearEarnings = Order::where('order_status','!=', 'canceled')
        ->where('payment_status',1)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('sub_total');

        $totalReview = ProductReview::count();

        $totalBrands = Brand::count();
        $totalCategories = Category::count();
        $totalUsers = User::where('role', 'user')->count();



        return view('Staff.dashboard', compact(
            'todaysOrder',
            'todaysPendingOrder',
            'totalOrders',
            'totalPendingOrders',
            'totalCanceledOrders',
            'totalCompleteOrders',
            'todaysEarnings',
            'monthEarnings',
            'yearEarnings',
            'totalReview',
            'totalBrands',
            'totalCategories',
            'totalUsers'
        ));
    }

}
