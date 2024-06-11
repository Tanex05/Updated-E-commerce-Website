<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\canceledOrderDataTable;
use App\DataTables\deliveredOrderDataTable;
use App\DataTables\OrderDataTable;
use App\DataTables\PendingOrderDataTable;
use App\DataTables\processedOrderDataTable;
use App\DataTables\shippedOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Foundation\Vite;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('Staff.order.index');
        view('Staff.order.index');
    }

    public function pendingOrders(PendingOrderDataTable $dataTable)
    {
        return $dataTable->render('Staff.order.pending-order');
    }

    public function processedOrders(processedOrderDataTable $dataTable)
    {
        return $dataTable->render('Staff.order.processed-order');
    }

    public function shippedOrders(shippedOrderDataTable $dataTable)
    {
        return $dataTable->render('Staff.order.shipped-order');
    }

    public function deliveredOrders(deliveredOrderDataTable $dataTable)
    {
        return $dataTable->render('Staff.order.delivered-order');
    }

    public function canceledOrders(canceledOrderDataTable $dataTable)
    {
        return $dataTable->render('Staff.order.canceled-order');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('Staff.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);

        // delete order products
        $order->orderProducts()->delete();
        // delete transaction
        $order->transaction()->delete();

        $order->delete();

        return response(['status' => 'success', 'message' => 'Deleted successfully!']);
    }

    public function changeOrderStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->order_status = $request->status;
        $order->save();

        return response(['status' => 'success', 'message' => 'Updated Order Status']);
    }

    public function changePaymentStatus(Request $request)
    {
        $paymentStatus = Order::findOrFail($request->id);
        $paymentStatus->payment_status = $request->status;
        $paymentStatus->save();

        return response(['status' => 'success', 'message' => 'Updated Payment Status Successfully']);
    }
}
