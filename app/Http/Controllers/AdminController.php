<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $id = Auth()->user()->id;
        $profileData = User::find($id);
        return view('admin.index', compact('profileData'));
    }


    public function destroy(Request $request): RedirectResponse
    {
        auth()->logout();
        // Auth::guard('web')->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function profile()
    {
        $id = Auth()->user()->id;
        $profileData = User::find($id);
        return view('admin.profile', compact('profileData'));
    }

    public function store(Request $request)
    {
        $id = Auth()->user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->phone = $request->phone;
        if ($request->hasFile('photo')) {
            // Store the uploaded file in the 'upload/admin_images' directory and get the path
            $path = $request->file('photo')->store('upload/admin_images', 'public');

            // Save the relative path to the database
            $data->photo = $path;
        }

        $data->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);

    }
    public function changePassword()
    {
        $id = Auth()->user()->id;
        $profileData = User::find($id);
        return view('admin.change_password', compact('profileData'));
    }


    public function UpdatePassword(Request $request)
    {
        //validating the request from the form
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        //get the authenticated user
        $user = Auth::user();

        // Verify the old password
        if (!Hash::check($request->old_password, $user->password)) {

            $notification = array(
                'message' => 'Old Password Not Correct',
                'alert-type' => 'error'
            );
            // Old password doesn't match
            return redirect()->back()->with($notification);
        }


        $notification = array(
            'message' => 'Password Updated Successfully',
            'alert-type' => 'success'
        );
        //udpating the users password
        //Hash::make() securely hashes the plain-text password ($request->new_password) before storing it in the database.
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->back()->with($notification);




    }



}
// $attributes = $this->ValidatePost();
// if (isset($attributes['thumbnail'])) {
//     $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
// }
// $post->update($attributes);
// return back()->with('success', 'Post Updated');

