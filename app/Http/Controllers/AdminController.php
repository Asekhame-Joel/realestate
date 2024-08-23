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
use Spatie\Permission\Models\Role;

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



    public function AllAdmin(){
        $id = Auth()->user()->id;
        $profileData = User::find($id);
        $alladmin = User::where('role', 'admin')->get();
        return view('admin.Backend.admin.alladmin', compact('profileData', 'alladmin'));
    }

    public function AddAdmin(){
        $id = Auth()->user()->id;
        $profileData = User::find($id);
        $roles = Role::all();

        return view('admin.Backend.admin.add_admin', compact('profileData', 'roles'));
    }

    public function StoreAdmin(Request $request)
    {
        // $roles = Role::all();
$user = new User;
$user->name = $request->name;
$user->username = $request->username;
$user->email = $request->email;
$user->address = $request->address;
$user->phone = $request->phone;
$user->password =  hash::make($request->password);
$user->role = 'admin';
$user->status = 'active';
$user->save();

        // if ($request->hasFile('photo')) {
        //     $user['photo'] = $request->file('photo')->move(public_path('upload/admin_images'), $request->file('photo')->getClientOriginalName());
        // }  

        // $user->roles()->detach();
        
        if($request->roles){
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'Admin Created Successfully',
            'alert-type' => 'success'

        );
        return redirect()->route('alladmin')->with($notification);

    }

    public function deleteAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        

        $notification = array(
            'message' => 'Admin Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('alladmin')->with($notification);
    }

    public function EditAdmin($id){
        $roles = Role::all();
        // $id = User::findOrFail($id);
        $profileData = User::find($id);
        return view('admin.Backend.admin.edit_admin', compact('profileData', 'roles'));

    }
    public function UpdateAdmin(Request $request, $id)
    {
        $profileData = User::find($id);
        $profileData->name = $request->input('name');
        $profileData->username = $request->input('username');
        $profileData->address = $request->input('address');
        $profileData->phone = $request->input('phone');
        $profileData->role = 'admin';
        $profileData->status = 'active';
        $profileData->update();

        $profileData->roles()->detach();
        if($request->roles){
            $profileData->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'Admin Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('alladmin')->with($notification);
    }
}
// $attributes = $this->ValidatePost();
// if (isset($attributes['thumbnail'])) {
//     $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
// }
// $post->update($attributes);
// return back()->with('success', 'Post Updated');

