<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyType;
use App\Models\User;


class propertyTypeController extends Controller
{
    public function AllType(){

        $id = Auth()->user()->id;
        $profileData = User::find($id);
        $types = PropertyType::latest()->get();
        return view('admin.Backend.properties.property_types', compact('profileData', 'types'));
    }
    public function AddType(){

        $id = Auth()->user()->id;
        $profileData = User::find($id);
        $types = PropertyType::latest()->get();
        return view('admin.Backend.properties.add_propertyType', compact('profileData', 'types'));
    }

    public function storeType(Request $request){
        request()->validate([
            'type_name' => 'required|unique:property_types',
            'type_icon' => 'required'
        ]);
        PropertyType::insert([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon
        ]);

        $notification = array(
            'message' => 'Property Created Successfully',
            'alert-type' => 'success'

        );
        return redirect()->route('all.types')->with($notification);

    }


    public function DestroyType(PropertyType $propertyType){
        $propertyType->delete();

        $notification = [
            'message' => 'Property Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);

        
    }
    public function EditType(PropertyType $propertyType){
        $id = Auth()->user()->id;
        $profileData = User::find($id);
        $types = PropertyType::latest()->get();
        return view('admin.Backend.properties.edit_propertyType', compact('profileData', 'types', 'propertyType'));
        
    }


    public function UpdateType(PropertyType $propertyType){
        $attributes =  request()->validate([
            'type_name' => 'required|unique:property_types',
            'type_icon' => 'required'
        ]);
        $propertyType->update($attributes);
        $notification = array(
            'message' => 'Property Updated Successfully',
            'alert-type' => 'success'

        );
        return redirect()->route('all.types')->with($notification);



    }
}
