<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use File;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function AdminDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Logged out Successfully',
            'alert-type' => 'info',
        );

        return redirect('/logout')->with($notification);
    }

    public function AdminLogoutPage(){


        return view('admin.admin_logout');
    }
    public function AdminProfile(){

        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }//end method

    public function AdminProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('photo')){

            $file = $request->file('photo');
            @unlink(public_path('upload/admin_image/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_image'),$filename);
            $data->photo = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }//end method

    public function ChangePassword(){

        return view('admin.change_password');
    }//end method

    public function UpdatePassword(Request $request){

        /// Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',

        ]);

        /// Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {

             $notification = array(
            'message' => 'Old Password Dones not Match!!',
            'alert-type' => 'error'
             );
            return back()->with($notification);

        }

        //// Update The New Password

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

            $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
             );
            return back()->with($notification);

    }// End Method

    ////////////////ADMIN USER////////////////

    public function AllAdmin(){

        $alladminuser = User::latest()->get();

        return view('backend.admin.all_admin', compact('alladminuser'));
    }

    public function AddAdmin(){

        $roles = Role::all();
        return view('backend.admin.add_admin', compact('roles'));
    }

    public function AdminUserStore(Request $request){

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();

        if($request->roles){

            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'new admin user created Successfully',
            'alert-type' => 'success'
             );
            return redirect()->route('all.admin')->with($notification);
    }

    public function EditAdmin($id){

        $roles = Role::all();
        $adminuser = User::findOrFail($id);

        return view ('backend.admin.edit_admin', compact('roles', 'adminuser'));
    }

    public function AdminUserUpdate(Request $request){

        $admin_id = $request->id;

        $user = User::findOrFail($admin_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        $user->roles()->detach();
        if($request->roles){

            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'new admin user updated Successfully',
            'alert-type' => 'success'
             );
            return redirect()->route('all.admin')->with($notification);
    }

    public function DeleteAdmin($id){

        $user = User::findOrFail($id);
        if (!is_null($user)){

            $user->delete();
        }

        $notification = array(
            'message' => 'new admin user deleted Successfully',
            'alert-type' => 'success'
             );
            return redirect()->back()->with($notification);
    }

    public function DatabaseBackup(){

        return view ('admin.db_backup')->with('files', File::allFiles(storage_path('app/bdt')));
    }

    public function BackupNow(){

        \Artisan::call('backup:run');

        $notification = array(
            'message' => 'backup Successfull',
            'alert-type' => 'success'
             );
            return redirect()->back()->with($notification);
    }

    public function DownloadDatabase($getFileName){

        $path = storage_path('app\bdt/'.$getFileName);

        return response()->download($path);
    }

    public function DeleteDatabase($getFileName){

        Storage::delete('bdt/'.$getFileName);

        $notification = array(
            'message' => 'database deleted Successfull',
            'alert-type' => 'success'
             );
            return redirect()->back()->with($notification);
    }
    
}

