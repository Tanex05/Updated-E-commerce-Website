<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CouponDataTable;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CouponDataTable $dataTable)
    {
        return $dataTable->render('Staff.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Staff.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'code' => ['required', 'max:200'],
            'quantity' => ['required', 'integer'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'discount_type' => ['required', 'max:200'],
            'discount' => ['required', 'integer'],
            'status' => ['required', 'integer'],
            'minimum_spend' => ['nullable', 'numeric'], // Validation for minimum_spend field
        ]);

        $coupon = new Coupon();
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->quantity = $request->quantity;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->discount_type = $request->discount_type;
        $coupon->discount = $request->discount;
        $coupon->minimum_spend = $request->minimum_spend; // Assigning minimum_spend value
        $coupon->total_used = 0;
        $coupon->status = $request->status;
        $coupon->save();

        toastr('Created Successfully', 'success', 'Success');

        return redirect()->route('coupons.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('Staff.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'code' => ['required', 'max:200'],
            'quantity' => ['required', 'integer'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'discount_type' => ['required', 'max:200'],
            'discount' => ['required', 'integer'],
            'status' => ['required', 'integer'],
            'minimum_spend' => ['nullable', 'numeric'], // Validation for minimum_spend field
        ]);

        $coupon = Coupon::findOrFail($id);
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->quantity = $request->quantity;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->discount_type = $request->discount_type;
        $coupon->discount = $request->discount;
        $coupon->minimum_spend = $request->minimum_spend; // Assigning minimum_spend value
        $coupon->status = $request->status;
        $coupon->save();

        toastr('Updated Successfully', 'success', 'Success');

        return redirect()->route('coupons.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }


    public function changeStatus(Request $request)
    {
        $coupon = Coupon::findOrFail($request->id);
        $coupon->status = $request->status == 'true' ? 1 : 0;
        $coupon->save();

        return response(['message' => 'Status has been updated!']);
    }
}
