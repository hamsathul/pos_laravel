<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use Carbon\Carbon;


class PosController extends Controller
{
    public function Pos(){

        $today_date = Carbon::now();
        $product = Product::where('expire_date','>',$today_date)->latest()->get();
        $customer = Customer::latest()->get();

        return view('backend.pos.pos_page', compact('product', 'customer'));
    } //end method

    public function AddCart(Request $request){

        Cart::add([
            'id' => $request->id,
             'name' => $request->name,
              'qty' => $request->qty,
               'price' => $request->price,
                'weight' => 20,
                 'options' => [],
      ]);

      $notification = array(

        'message' => 'Product Added successfully',
        'alert-type' => 'success',
    );

    return redirect()->back()->with($notification);
    }//end method

    public function AllItem(){

        $product = Cart::content();

        return view('backend.pos.test_item', compact('product'));
    }

    public function UpdateCart(Request $request, $rowId){

        $qty = $request->qty;
        $update = Cart::update($rowId, $qty);

        $notification = array(

            'message' => 'cart updated successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function DeleteCart($rowId){
        $delete = Cart::remove($rowId);

        $notification = array(

            'message' => 'item deleted successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function CreateInvoice(Request $request){


        $contents = Cart::content();
        $customer_id = $request->customer_id;
        $customer = Customer::where('id',$customer_id)->first();
        return view('backend.invoice.product_invoice', compact('contents', 'customer'));

    }//end method
}
