<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderAddress;
use App\Models\User;
use Illuminate\Http\Request;

class ManagecustomerController extends Controller
{
    public function index(){
        $users = User::where('is_admin',0)->get();
        return view('admin.managecustomer.index',compact('users'));
    }
    public function show($id){
        $order = Order::where('user_id',$id)->get();
        // dd($order);
        return view('admin.managecustomer.show',compact('order'));
    }
    public function view($id){
        $order = Order::find($id);
        $billingAddress = OrderAddress::where('order_id', $id)->where('address_type', 'billing')->first();
        $shippingAddress = OrderAddress::where('order_id', $id)->where('address_type', 'shipping')->first();
        $orderItems = OrderItem ::where('order_id', $id)->get();
        return view('admin.managecustomer.view',compact('order','billingAddress','shippingAddress','orderItems'));
    }

}
