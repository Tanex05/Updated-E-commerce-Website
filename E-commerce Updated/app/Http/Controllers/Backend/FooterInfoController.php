<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FooterInfo;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FooterInfoController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $footerInfo = FooterInfo::first();
        return view('Staff.footer.footer-info.index', compact('footerInfo'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'logo' => ['nullable', 'image', 'max:3000'],
            'favicon' => ['nullable', 'image', 'max:3000'],
            'phone' => ['max:100'],
            'email' => ['max:100'],
            'address' => ['max:300'],
            'copyright' => ['max:200'],
        ]);

        $footerInfo = FooterInfo::find($id);

        if ($footerInfo) {
            // Handle file upload
            $logoPath = $this->updateImage($request, 'logo', 'uploads', $footerInfo->logo);
            $faviconPath = $this->updateImage($request, 'favicon', 'uploads', $footerInfo->favicon);

            $updateData = [
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'copyright' => $request->copyright,
                'map' => $request->map
            ];

            // Update logo and/or favicon paths if they were uploaded
            if (!empty($logoPath)) {
                $updateData['logo'] = $logoPath;
            }

            if (!empty($faviconPath)) {
                $updateData['favicon'] = $faviconPath;
            }

            $footerInfo->update($updateData);

            Cache::forget('footer_info');

            toastr('Updated successfully!', 'success', 'success');
        }

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
