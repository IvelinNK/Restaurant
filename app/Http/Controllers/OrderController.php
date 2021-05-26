<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrdersDetail;
use App\Product;
use App\LandingPage;
use Config;

class OrderController extends Controller
{
    public function viewOrder(Request $request, $id=null){
        $table = $request->session()->get('table');
        if ($id != null){
            $order = Order::where(['id'=>$id])->first();
            if (!empty($order)){
                if($order->table_id == $table){
                        $orders_details = OrdersDetail::where(['order_id'=>$id])->get();
                        return view('front.view_order')->with(
                        [
                            'order'=>$order,
                            'orders_details'=>$orders_details
                        ]
                    );        
                }else{
                    return redirect('/');
                }
            }   
            else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
    }

    public function addOrder(Request $request){
        if ($request->isMethod('post') && !empty($request->order_id) && !empty($request->product_id) && !empty($request->quantity)){
            $orders_details = new OrdersDetail();
            $orders_details->order_id = $request->order_id;
            $orders_details->product_id = $request->product_id;
            $orders_details->quantity = $request->quantity;
            $orders_details->status = "ordered";
            $orders_details->info = $request->info;
            $orders_details->save();

            return redirect('/order/'.$request->order_id);
        }else{
            return redirect('/');
        }
    }

    public function delOrderProduct(Request $request, $id=null){
        if ($id != null){
            $orders_details = OrdersDetail::where(['id'=>$id])->first();
            $order_id = $orders_details->order_id;
            if ($orders_details->status == "ordered"){
                $orders_details->delete();    
            }
            return redirect('/order/'.$order_id);
        }else{
            return redirect('/');
        }
    }

    public function editOrder(Request $request, $id=null){
        $order = Order::where(['id'=>$id])->first();
        $orders_details = OrdersDetail::where(['order_id'=>$id])->get();
        return view('admin.orders.edit_order')->with([
            'order'=>$order,
            'orders_details'=>$orders_details
        ]);
    }

    public function changeCooked(Request $request, $id=null){
        $product_order = OrdersDetail::where(['id'=>$id])->first();
        $order = Order::where(['id'=>$product_order->order_id])->first();
        $product_order->status = "cooked";
        $product_order->save();
        $orders_details = OrdersDetail::where(['order_id'=>$product_order->order_id])->get();
        return view('admin.orders.edit_order')->with([
            'order'=>$order,
            'orders_details'=>$orders_details
        ]);
    }

    public function changeDelivered(Request $request, $id=null){
        $product_order = OrdersDetail::where(['id'=>$id])->first();
        $order = Order::where(['id'=>$product_order->order_id])->first();
        $product_order->status = "delivered";
        $product_order->save();
        $orders_details = OrdersDetail::where(['order_id'=>$product_order->order_id])->get();
        return view('admin.orders.edit_order')->with([
            'order'=>$order,
            'orders_details'=>$orders_details
        ]);
    }

    public function deleteProductOrder(Request $request, $id=null){
        $product_order = OrdersDetail::where(['id'=>$id])->first();
        $order = Order::where(['id'=>$product_order->order_id])->first();
        $order_id = $product_order->order_id;
        $orders_details = OrdersDetail::where(['order_id'=>$product_order->order_id])->get();
        $product_order->delete();
        return redirect('/admin/edit-order/'.$order_id);
    }

    public function deleteAdminOrder(Request $request, $id=null){
        if (!empty($id)){
            $order = Order::where(['id'=>$id])->first();
            // Delete order
            $order->delete();
        }
        return redirect('/admin/view-orders');
    }

    public function closeAdminOrder(Request $request, $id=null){
        if (!empty($id)){
            $order = Order::where(['id'=>$id])->first();
            $order->status = "closed";
            $order->save();
            $affected = OrdersDetail::where(['order_id'=>$order->id])->update(['status' => "delivered"]);
        }
        return redirect('/admin/view-orders');
    }

    public function viewOrders(){
        $orders = Order::all();
        return view('admin.orders.view_orders')->with(['orders'=>$orders]);
    }

}
