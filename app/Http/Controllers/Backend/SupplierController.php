<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class SupplierController extends Controller
{
    public function AllSupplier(){
        $supplier = Supplier::latest()->get();

        return view('backend.supplier.all_supplier', compact('supplier'));

    } //end method

    public function AddSupplier(){


        return view('backend.supplier.add_supplier');

    } //end method

    public function StoreSupplier(Request $request){

        $validateData = $request->validate([

            'name' => 'required|max:200',
            'email' => 'required|unique:employees|max:200',
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
            'type' => 'required',
            'shopname' => 'required|max:200',
            'account_holder' => 'required|max:200',
            'account_number' => 'required',

        ],

        [
            'name.required' => 'This employee field is required',
        ]
    );
        if ($request->file('image')){
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/supplier/'.$name_gen);
        $save_url = 'upload/supplier/'.$name_gen;
        }else{
            $save_url = 'upload/no_image.jpg';
        }

        Supplier::insert([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopname' => $request->shopname,
            'type' => $request->type,
            'image' => $save_url,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            '$message' => 'supplier Created Successfully',
            'alert_type' => 'success',
        );

        return redirect()->route('all.supplier')->with($notification);

    } //end method

    public function EditSupplier($id){

        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.edit_supplier', compact('supplier'));

    } //end method

    public function UpdateSupplier(Request $request){

        $supplier_id = $request->id;

        if($request->file('image')){

        $supplier_image = Supplier::findOrFail($supplier_id);
        unlink($supplier_image->image);
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/supplier/'.$name_gen);
        $save_url = 'upload/supplier/'.$name_gen;

        Supplier::findOrFail($supplier_id)->update([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopname' => $request->shopname,
            'image' => $save_url,
            'type' => $request->type,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,



        ]);

        $notification = array(
            'message' => 'supplier Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.supplier')->with($notification);

        }else{

            Supplier::findOrFail($supplier_id)->update([

                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'type' => $request->type,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'city' => $request->city,


            ]);

            $notification = array(
                'message' => 'supplier Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.supplier')->with($notification);
        }

    } //end method

    public function DeleteSupplier($id){

        $supplier_image = Supplier::findOrFail($id);
        $img = $supplier_image->image;
        unlink($img);

        Supplier::findOrFail($id)->delete();

        $notification = array(
            'message' => 'supplier Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } //end method

    public function ViewSupplier($id){

        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.view_supplier', compact('supplier'));

    } //end method
}
