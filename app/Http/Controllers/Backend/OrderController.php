<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Orderdetails;
use Helper;
use DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;



class OrderController extends Controller
{
    public function FinalInvoice(Request $request){

        $rtotal = $request->total;
        $pay = $request->pay;
        $mdue = $rtotal - $pay;
        $data = array();
        $data['customer_id'] = $request->customer_id;
        $data['order_date'] = $request->order_date;
        $data['order_status'] = $request->order_status;
        $data['total_products'] = $request->total_products;
        $data['sub_total'] = $request->sub_total;
        $data['vat'] = $request->vat;
        $data['invoice_no'] = 'BDT'.mt_rand(1000,99999999);
        $data['total'] = $request->total;
        $data['payment_status'] = $request->payment_status;
        $data['pay'] = $request->pay;
        $data['due'] = $mdue;
        $data['created_at'] = Carbon::now();

        $order_id = Order::insertGetId($data);
        $contents = Cart::content();

        $pdata = array();
        foreach ($contents as $content) {

            $pdata['order_id'] = $order_id;
            $pdata['product_id'] = $content->id;
            $pdata['quantity'] = $content->qty;
            $pdata['unitcost'] = $content->price;
            $pdata['total'] = $content->total;
            $pdata['created_at'] = Carbon::now();

            $insert = Orderdetails::insert($pdata);
        }
        $notification = array(
            'message' => 'Order Completed Successfully',
            'alert-type' => 'success'
        );

        Cart::destroy();

        return redirect()->route('dashboard')->with($notification);
    }//end method

    public function PendingOrder(){

        $orders = Order::where('order_status', 'pending')->get();
        return view('backend.order.pending_order', compact('orders'));
    }

    public function OrderDetails($order_id){

        $order = Order::where('id',$order_id)->first();
        $orderitem = Orderdetails::with('product')->where('order_id', $order_id)->orderBy('id','DESC')->get();
        return view('backend.order.order_details', compact('order', 'orderitem'));
    }
    public function OrderStatusUpdate(Request $request){
        $order_id = $request->id;

        $product = Orderdetails::where('order_id', $order_id)->get();
        foreach($product as $item){
            Product::where('id', '$item->product_id')->update([
                'product_store' => DB::raw('product_store-'.$item->quantity)
            ]);
        }

        Order::findOrFail($order_id)->update([

            'order_status' => 'complete',
        ]);
        $notification = array(
            'message' => 'Order Completed Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('pending.order')->with($notification);
    }

    public function CompleteOrder(){

        $orders = Order::where('order_status','complete')->get();


        return view('backend.order.complete_order', compact('orders'));
    }

    public function StockManage(){

        $product = Product::latest()->get();
        return view('backend.stock.all_stock', compact('product'));
    }

    public function InvoiceDownload($order_id){

        $order = Order::where('id',$order_id)->first();
        $orderitem = Orderdetails::with('product')->where('order_id', $order_id)->orderBy('id','DESC')->get();
        $pdf = Pdf::loadview('backend.order.order_invoice', compact('order', 'orderitem'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }// end method

    public function PendingDue(){

        $alldue = Order::where('due','>','0')->orderBy('id','DESC')->get();

        return view ('backend.order.pending_due', compact('alldue'));
    }

    public function OrderDueAjax($id){

        $order = Order::findOrFail($id);

        return response()->json($order);
    }

    public function UpdateDue(Request $request){

        $order_id = $request->id;
        $due_amount = $request->due;
        $pay_amount = $request->pay;

        $allorder = Order::findOrFail($order_id);
        $maindue = $allorder->due;
        $mainpay = $allorder->pay;
        $paid_due = $maindue - $due_amount;
        $paid_pay = $mainpay + $due_amount;

        Order::findOrFail($order_id)->update([

            'due' => $paid_due,
            'pay' => $paid_pay,
        ]);

        $notification = array(
            'message' => 'Due Amount Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('pending.due')->with($notification);


    }
}
