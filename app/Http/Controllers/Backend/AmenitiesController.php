<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Models\Amenities;
use App\Models\User;


class AmenitiesController extends Controller
{
    public function AllAmenities()
    {

        $id = Auth()->user()->id;
        $profileData = User::find($id);
        $amenities = Amenities::latest()->get();
        return view('admin.Backend.amenities.amenities_type', compact('profileData', 'amenities'));

    }

    public function AddAmenities()
    {

        $id = Auth()->user()->id;
        $profileData = User::find($id);
        $amenities = Amenities::latest()->get();
        return view('admin.Backend.amenities.add_amenities', compact('profileData', 'amenities'));

    }

    public function EditAmenities(Amenities $amenities)
    {
        $id = Auth()->user()->id;
        $profileData = User::find($id);
        $amenities_name = Amenities::latest()->get();
        return view('admin.Backend.amenities.edit_amenities', compact('profileData', 'amenities_name', 'amenities'));

    }
    public function UpdateAmenities(Amenities $amenities)
    {
        $attributes = request()->validate([
            'amenities_name' => 'required|unique:amenities',
        ]);
        $amenities->update($attributes);
        $notification = array(
            'message' => 'Amenities Updated Successfully',
            'alert-type' => 'success'

        );
        return redirect()->route('all.amenities')->with($notification);



    }

    public function StoreAmenities(Request $request)
    {
        request()->validate([
            'amenities_name' => 'required|unique:amenities',
        ]);
        Amenities::insert([
            'amenities_name' => $request->amenities_name,
        ]);

        $notification = array(
            'message' => 'Amenities Created Successfully',
            'alert-type' => 'success'

        );
        return redirect()->route('all.amenities')->with($notification);

    }

    public function DestroyAmenities(Amenities $amenities)
    {
        $amenities->delete();

        $notification = [
            'message' => 'Amenities Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);


    }


}
