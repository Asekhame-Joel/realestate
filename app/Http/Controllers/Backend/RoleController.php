<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


use App\Models\User;
use App\Exports\PermissionExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PermissionImport;
use DB;

class RoleController extends Controller
{
    public function AllPermission()
    {

        $permission = Permission::all();
        $id = Auth()->user()->id;
        $profileData = User::find($id);

        return view('admin.Backend.permissions.all_permissions', compact('profileData', 'permission'));

    }
    public function AddPermission()
    {
        $permission = Permission::all();
        $id = Auth()->user()->id;
        $profileData = User::find($id);
        return view('admin.Backend.permissions.add_permissions', compact('profileData', 'permission'));

    }

    public function StorePermission(Request $request)
    {
        Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);

        $notification = array(
            'message' => 'Property Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);


    }
    public function EditPermission(Permission $permissions)
    {
        $id = Auth()->user()->id;
        $profileData = User::find($id);
        $permission = Permission::latest()->get();
        return view('admin.Backend.permissions.edit_permissions', compact('profileData', 'permission', 'permissions'));

    }

    public function UpdatePermission(Permission $permissions)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'group_name' => 'nullable' // Make group_name nullable
        ]);
        $attributes = array_merge($attributes, [
            'group_name' => $attributes['group_name'] ?? $permissions->group_name,
        ]);

        $permissions->update($attributes);

        $notification = array(
            'message' => 'Permission Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    }

    public function destroy(Permission $permissions)
    {
        $permissions->delete();

        $notification = array(
            'message' => 'Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    }

    public function ImportPermission()
    {

        $id = Auth()->user()->id;
        $profileData = User::find($id);

        return view('admin.Backend.permissions.import_permissions', compact('profileData'));

    }

    public function export()
    {
        return Excel::download(new PermissionExport, 'permission.xlsx');
    }

    public function import()
    {
        request()->validate([
            'import_file' => 'required|mimes:xlsx',
        ]);
        $path = request()->file('import_file')->storeAs('import', 'newpermission.xlsx');

        Excel::import(new PermissionImport, $path);

        $notification = array(
            'message' => 'Permission Data Uploaded Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);

    }

    //roles coontrollers 
    public function AllRoles()
    {
        $roles = Role::all();
        $id = Auth()->user()->id;
        $profileData = User::find($id);

        return view('admin.Backend.roles.all_roles', compact('profileData', 'roles'));

    }

    public function AddRoles()
    {
        $roles = Role::all();
        $id = Auth()->user()->id;
        $profileData = User::find($id);
        return view('admin.Backend.roles.add_roles', compact('profileData', 'roles'));

    }

    public function StoreRoles(Request $request)
    {
        Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);


    }
    public function EditRoles(Role $roles)
    {
        $id = Auth()->user()->id;
        $profileData = User::find($id);
        $role = Role::latest()->get();
        return view('admin.Backend.roles.edit_roles', compact('profileData', 'role', 'roles'));

    }

    public function UpdateRoles(Role $roles)
    {
        $attributes = request()->validate([
            'name' => 'required',
        ]);

        $roles->update($attributes);

        $notification = array(
            'message' => 'Role Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);
    }

    public function deleteRoles(Role $roles)
    {
        $roles->delete();

        $notification = array(
            'message' => 'Role Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);
    }


    public function RolePermission()
    {

        $permissions = Permission::all();
        $roles = Role::all();
        $id = Auth()->user()->id;
        $profileData = User::find($id);
        $permissiongroup = User::getPermissionGroup();


        return view('admin.Backend.roles.role_permission', compact('profileData', 'permissions', 'roles', 'permissiongroup'));

    }

    public function StoreRolePermission(Request $request)
    {

        $validatedData = $request->validate([
            'role_id' => 'required|integer',
            'pn' => 'required|array', // Ensure pn is an array of permissions
            'pn.*' => 'integer', // Ensure each permission ID is an integer
        ]);

        $roleId = (int) $validatedData['role_id'];
        $permissions = $validatedData['pn'];

        $attributes = [];

        foreach ($permissions as $permissionId) {
            $attributes[] = [
                'role_id' => $roleId,
                'permission_id' => (int) $permissionId, // Cast to integer
            ];
        }
        DB::table('role_has_permissions')->where('role_id', $roleId)->delete();
        DB::table('role_has_permissions')->insert($attributes);

        $notification = array(
            'message' => 'Role Permisson Granted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('allrole.permission')->with($notification);
    }

    public function AllRolePermission()
    {

        $roles = Role::all();
        $permissions = Permission::all();
        $id = Auth()->user()->id;
        $profileData = User::find($id);
        return view('admin.Backend.roles.all_roles_permission', compact('profileData', 'roles', 'permissions'));

    }

    public function EditRolePermission($id)
    {

        $roles = Role::findOrFail($id);
        $permissions = Permission::all();
        $id = Auth()->user()->id;
        $profileData = User::find($id);
        $permissiongroup = User::getPermissionGroup();
        return view('admin.Backend.Rolesetup.editrole_permission', compact('profileData', 'roles', 'permissions', 'permissiongroup'));
    }

    public function UpdateRolePermission(Request $request, $id)
    {
        // Validate that 'pn' contains valid permission IDs
        $validatedData = $request->validate([
            'pn' => 'nullable|array',
            'pn.*' => 'exists:permissions,id',
        ]);
    
        // Find the role by ID
        $roles = Role::findOrFail($id);
    
        // Retrieve the permission names based on the provided IDs
        $permissions = Permission::whereIn('id', $validatedData['pn'] ?? [])->pluck('name');
    
        // Sync the permissions using the names instead of IDs
        $roles->syncPermissions($permissions);
    
        // Prepare a success notification
        $notification = array(
            'message' => 'Role Permission Updated Successfully',
            'alert-type' => 'success'
        );
    
        // Redirect to the route with a success notification
        return redirect()->route('allrole.permission')->with($notification);
    }

    public function deleteRolePermission($id){

        $roles = Role::findOrFail($id);
        if(!is_null($roles)){
       $roles->delete();

        }
           // Prepare a success notification
           $notification = array(
            'message' => 'Role Permission Deleted Successfully',
            'alert-type' => 'success'
        );
    
        // Redirect to the route with a success notification
        return redirect()->back()->with($notification);
    }

   



}




