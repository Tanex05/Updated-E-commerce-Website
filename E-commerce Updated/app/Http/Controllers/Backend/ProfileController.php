<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ImageUploadTrait;
use File;

class ProfileController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        return view('Staff.profile.index');
    }
    /** Update Profile */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'image' => ['image', 'max:2048'],
            'name' => ['required', 'max:100'],
            'email' => ['required', 'unique:users,email,'.Auth::user()->id]
        ]);

        $user = Auth::user();

        $imagePath = $this->updateImage($request, 'image', 'uploads', $user->image);
        $user->image = empty(!$imagePath) ? $imagePath : $user->image;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        toastr()->success('Updated Profile Successfully!', 'Success');

        return redirect()->back();
    }
       /** Update Password */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        toastr()->success('Updated Password Successfully!');
        return redirect()->back();
    }

}
