<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use DB;

class RoleController extends Controller
{
    public function AllPermission(){

        $permissions = Permission::all();
        return view('backend.pages.permission.all_permission', compact('permissions'));
    }

    public function AddPermission(){

        return view ('backend.pages.permission.add_permission');
    }

    public function StorePermission(Request $request){

        $role = Permission::create([

            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(

            'message' => 'permission added successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.permission')->with($notification);
    }
    public function editPermission($id){

        $permission = Permission::findOrFail($id);
        return view ('backend.pages.permission.edit_permission', compact('permission'));
    }

    public function UpdatePermission(Request $request){

        $permission_id = $request->id;
        Permission::findOrFail($permission_id)->update([

            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(

            'message' => 'permission updated successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.permission')->with($notification);
    }

    public function DeletePermission($id){

        Permission::findOrFail($id)->delete();

        $notification = array(

            'message' => 'permission deleted successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    //////////////ROLES METHODS////////////////////////

    public function AllRoles(){

       $roles = Role::all();
       return view('backend.pages.roles.all_roles', compact('roles'));
    }

    public function AddRoles(){

        return view('backend.pages.roles.add_roles');
    }

    public function StoreRoles(Request $request){

        $role = Role::create([

            'name' => $request->name,
        ]);

        $notification = array(

            'message' => 'role added successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.roles')->with($notification);
    }

    public function editRoles($id){

        $roles = Role::findOrFail($id);
        return view ('backend.pages.roles.edit_roles', compact('roles'));
    }

    public function UpdateRoles(Request $request){

        $role_id = $request->id;
        Role::findOrFail($role_id)->update([

            'name' => $request->name,
        ]);

        $notification = array(

            'message' => 'role updated successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.roles')->with($notification);
    }

    public function DeleteRoles($id){

        Role::findOrFail($id)->delete();

        $notification = array(

            'message' => 'Role deleted successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    /////////ADD ROLES PERMISSION ///////////////////////

    public function AddRolesPermission(){

        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();

        return view('backend.pages.roles.add_roles_permission', compact('roles', 'permissions', 'permission_groups'));
    }

    public function StoreRolePermission(Request $request){

        $data = array();
        $permissions = $request->permission;
        foreach($permissions as $key => $item){
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);

        }

        $notification = array(

            'message' => 'Role permission added successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.roles.permission')->with($notification);
    }

    public function AllRolesPermission(){

        $roles = Role::all();

        return view('backend.pages.roles.all_roles_permission', compact('roles'));
    }

    public function AdminRolesEdit($id){

        $roles = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();

        return view('backend.pages.roles.edit_roles_permission', compact('roles', 'permissions', 'permission_groups'));
    }

    public function UpdateRolePermission(Request $request, $id){

        $role = role::findOrFail($id);
        $permissions = $request->permission;
        if (!empty($permissions)){
            $role->syncPermissions($permissions);
        }
        $notification = array(

            'message' => 'Role permission updated successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.roles.permission')->with($notification);
    }

    public function DeleteRolePermission($id){

        $role = Role::findOrFail($id);
        if (!is_null($role)){
            $role->delete();
        }

        $notification = array(

            'message' => 'Role permission deleted successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
