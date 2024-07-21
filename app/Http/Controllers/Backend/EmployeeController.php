<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function AllEmployee(){
        $employee = Employee::latest()->get();

        return view('backend.employee.all_employee', compact('employee'));

    } //end method

    public function AddEmployee(){


        return view('backend.employee.add_employee');

    } //end method

    public function StoreEmployee(Request $request){

        $validateData = $request->validate([

            'name' => 'required|max:200',
            'email' => 'required|unique:employees|max:200',
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
            'salary' => 'required|max:200',
            'vacation' => 'required|max:200',

        ],

        [
            'name.required' => 'This employee field is required',
        ]
    );
        if ($request->file('image')){
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/employee/'.$name_gen);
        $save_url = 'upload/employee/'.$name_gen;
        }else{
            $save_url = 'upload/no_image.jpg';
        }

        Employee::insert([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'experience' => $request->experience,
            'image' => $save_url,
            'salary' => $request->salary,
            'vacation' => $request->vacation,
            'city' => $request->city,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            '$message' => 'Employee Created Successfully',
            'alert_type' => 'success',
        );

        return redirect()->route('all.employee')->with($notification);

    } //end method

    public function EditEmployee($id){

        $employee = Employee::findOrFail($id);
        return view('backend.employee.edit_employee', compact('employee'));

    } //end method

    public function UpdateEmployee(Request $request){

        $employee_id = $request->id;

        if($request->file('image')){

        $employee_image = Employee::findOrFail($employee_id);
        unlink($employee_image->image);
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/employee/'.$name_gen);
        $save_url = 'upload/employee/'.$name_gen;

        Employee::findOrFail($employee_id)->update([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'experience' => $request->experience,
            'image' => $save_url,
            'salary' => $request->salary,
            'vacation' => $request->vacation,
            'city' => $request->city,


        ]);

        $notification = array(
            'message' => 'Employee Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.employee')->with($notification);

        }else{

            Employee::findOrFail($employee_id)->update([

                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'experience' => $request->experience,
                'salary' => $request->salary,
                'vacation' => $request->vacation,
                'city' => $request->city,

            ]);

            $notification = array(
                'message' => 'Employee Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.employee')->with($notification);
        }

    } //end method

    public function DeleteEmployee($id){

        $employee_image = Employee::findOrFail($id);
        $img = $employee_image->image;
        unlink($img);

        Employee::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Employee Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } //end method

}


