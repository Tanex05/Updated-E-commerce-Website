<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AdminApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class AdminApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $AdminApi = AdminApi::first();
        return view('Staff.admin-api.index', compact('AdminApi'));
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
        //
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
        $request->validate([
            'tawk_to' => ['nullable'],
            'paymongo_secret_key' => ['nullable'],
        ]);

        // Attempt to find an existing AdminApi record by its ID
        $AdminApi = AdminApi::find($id);

        // If the AdminApi record doesn't exist, create a new one
        if (!$AdminApi) {
            $AdminApi = new AdminApi();
        }


        // Update or create the record with the provided data
        $AdminApi->updateOrCreate(['id' => $id], [
            'tawk_to' => $request->tawk_to,
            'paymongo_secret_key' => $request->paymongo_secret_key
        ]);

        // Clear cache for the updated/created AdminApi instance settings
        Cache::forget('admin_api_settings_' . $id);

        toastr('Updated successfully!', 'success', 'success');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
