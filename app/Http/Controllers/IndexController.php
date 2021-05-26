<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\LandingPage;
use App\Order;
use Config;

class IndexController extends Controller
{
    public static function getUserIP()
    {
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];
        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }
        return $ip;
    }

    public function maintenance()
    {
        return view('maintenance');
    }

    public function index(){
        return view('index')->with([
            'index_meta_title'=>'Ресторант "При Иво"',
            'index_meta_decription'=>'Ресторант "При Иво"',
            'index_meta_keywords'=>'Ресторант'
        ]);
    }

    public function table(Request $request, $id = null){
        if ($id != null && $id > 0 && $id < 9){
            switch ($id) {
                case 1:
                    $table_status = Order::where(['table_id'=>1, 'status'=>'work'])->count();
                    break;
                case 2:
                    $table_status = Order::where(['table_id'=>2, 'status'=>'work'])->count();
                    break;
                case 3:
                    $table_status = Order::where(['table_id'=>3, 'status'=>'work'])->count();
                    break;
                case 4:
                    $table_status = Order::where(['table_id'=>4, 'status'=>'work'])->count();
                    break;
                case 5:
                    $table_status = Order::where(['table_id'=>5, 'status'=>'work'])->count();
                    break;
                case 6:
                    $table_status = Order::where(['table_id'=>6, 'status'=>'work'])->count();
                    break;
                case 7:
                    $table_status = Order::where(['table_id'=>7, 'status'=>'work'])->count();
                    break;
                case 8:
                    $table_status = Order::where(['table_id'=>8, 'status'=>'work'])->count();
                    break;
                default:
                    $table_status = Order::where(['table_id'=>1, 'status'=>'work'])->count();
                    break;
            }
            $current_table = $request->session()->get('table');
            if ($table_status == 0 || ($table_status != 0 && $current_table == $id)){
                session(['table' => $id]);

                if ($table_status == 0){
                    //create order table
                    $order = new Order();
                    $order->table_id = $id;
                    $order->status = "work";
                    $order->save();
                }else{
                    $order = Order::where(['table_id'=>$id, 'status'=>'work'])->first();
                }

                $categories_count = Category::count();
                if ($categories_count >= 12){
                    $categories_count = 12;
                }
                $categories = Category::where('id', '>', 0)->take($categories_count)->get();
                
                $featured_products_count = Product::where(['featured'=>1, 'status'=>'active'])->count();
                if ($featured_products_count >= 6){
                    $featured_products_count = 6;
                }
                $featured_products = Product::where(['featured'=>1, 'status'=>'active'])->get()->take($featured_products_count);
        
                $property = LandingPage::first();
                return view('table')->with([
                    'categories'=>$categories,
                    'featured_products'=>$featured_products,
                    'property'=>$property,
                    'order'=>$order,
                    'index_meta_title'=>'Ресторант "При Иво"',
                    'index_meta_decription'=>'Ресторант "При Иво"',
                    'index_meta_keywords'=>'Ресторант'
                ]);                                
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
    }

    public function editLandingPage(Request $request){
        $property = LandingPage::first();
        if ($request->isMethod('post')){
            $property->footer_rites = $request->input('footer_rites');
            $property->save();
        }
        return view('admin.properties.edit_landing_page')->with([
            'property'=>$property
        ]);
    }

    public function editMaintenancePage(Request $request){
        $property = LandingPage::first();
        if ($request->isMethod('post')){
            $property->maintenance_status = $request->input('maintenance_status');
            $property->maintenance_ip = $request->input('maintenance_ip');
            $property->save();
        }
        return view('admin.properties.edit_maintenance_page')->with([
            'property'=>$property
        ]);
    }

}
