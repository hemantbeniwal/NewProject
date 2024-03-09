<?php

namespace App\Http\Controllers;

use App\Models\OrderAddress;
use App\Models\Quote;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\QuoteItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
   public function addToCheckout()
   {
      $cart_id = Session::get('cart_id');
      $cartdata = Quote::where('cart_id', $cart_id)->first();
      // dd($cartdata);
      return view('web.checkout', compact('cartdata'));
   }
   public function checkoutStore(Request $request)
   {

      $data = $request->all();
      // dd($data);
      if ($request->has('ship_to_different_address')) {
         $request->validate([

            'shipping_name' => 'required|string|max:25',
            'shipping_email' => 'required|email|max:50',
            'shipping_phone' => 'required|string|max:12',
            'shipping_address' => 'required|string|max:150',
            'shipping_country' => 'required|string|max:15',
            'shipping_state' => 'required|string|max:25',
            'shipping_city' => 'required|string|max:20',
            'shipping_pincode' => 'required|string|max:6|min:6',
         ]);
      } else {
         $request->validate([

            'billing_name' => 'required|string|max:25',
            'billing_email' => 'required|email|max:50',
            'billing_phone' => 'required|string|max:12',
            'billing_address' => 'required|string|max:150',
            'billing_country' => 'required|string|max:15',
            'billing_state' => 'required|string|max:25',
            'billing_city' => 'required|string|max:20',
            'billing_pincode' => 'required|string|max:6|min:6',
         ]);
      }

      $request->validate([
         'shipping_method' => 'required',
         'payment' => 'required',
      ]);

      if ($request->shipping_method == "standard_delivery") {
         $shippingCost = 0;
      } elseif ($request->shipping_method == "express_delivery") {
         $shippingCost = 100;
      } elseif ($request->shipping_method == "next_business_day") {
         $shippingCost = 50;
      };
      $cartId = Session::get('cart_id');
      // dd($cartId);
      $quotes = Quote::where('cart_id', $cartId)->first();
      //   dd($quotes);
      $lastOrder = Order::orderBy('order_id', 'desc')->first();
      if ($lastOrder) {
         $lastId = (int)Str::substr($lastOrder->order_id, -7);
         $orderIncrementId = Str::padLeft($lastId + 1, 7, '0');
      } else {
         $orderIncrementId = '1000000';
      }
      $orderData = Order::create([
         'order_id' => $orderIncrementId,
         'user_id' => $data['user_id'] ?? Auth::user()->id,
         'name' => $data['billing_name'],
         'email' => $data['billing_email'],
         'phone' => $data['billing_phone'],
         'address' => $data['billing_address'],
         'address_2' => $data['billing_address_2'],
         'city' => $data['billing_city'],
         'state' => $data['billing_state'],
         'country' => $data['billing_country'],
         'pincode' => $data['billing_pincode'],
         'subtotal' => $quotes->subtotal,
         'coupon' => $quotes->coupon,
         'coupon_discount' => $quotes->coupon_discount ?? 00,
         'shipping_cost' => $shippingCost,
         'total' => $quotes->total + $shippingCost,
         'payment_method' => $request->payment,
         'shipping_method' => $request->shipping_method
      ]);
      foreach ($quotes->quoteItems as $quote) {
         // dd($quote);
         // echo $item->name . '<br>';
         OrderItem::create([
            'order_id' => $orderData->id,
            'product_id' => $quote->product_id,
            'name' => $quote->name,
            'sku' => $quote->sku,
            'price' => $quote->price,
            'qty' => $quote->qty,
            'row_total' => $quote->row_total,
            'custom_option' => $quote->custom_option
         ]);
         // dd($data);
      }

      // dd($orderData);

      $billingAddressType = "billing";
      $shippingAddressType = "shipping";

      $billingAddress = [
         'order_id' => $orderData->id,
         'user_id' => $data['user_id'] ?? Auth::user()->id,
         'name' => $data['billing_name'],
         'email' => $data['billing_email'],
         'phone' => $data['billing_phone'],
         'address' => $data['billing_address'],
         'address_2' => $data['billing_address_2'],
         'city' => $data['billing_city'],
         'state' => $data['billing_state'],
         'country' => $data['billing_country'],
         'pincode' => $data['billing_pincode'],
         'address_type' => $billingAddressType
      ];

      $shippingAddress = [
         'order_id' => $orderData->id,
         'user_id' => $data['user_id'] ?? Auth::user()->id,
         'name' => $data['shipping_name'],
         'email' => $data['shipping_email'],
         'phone' => $data['shipping_phone'],
         'address' => $data['shipping_address'],
         'address_2' => $data['shipping_address_2'],
         'city' => $data['shipping_city'],
         'state' => $data['shipping_state'],
         'country' => $data['shipping_country'],
         'pincode' => $data['shipping_pincode'],
         'address_type' => $shippingAddressType
      ];

      OrderAddress::create($billingAddress);


      if ($request->ship_to_different_address == "on") {

         OrderAddress::create($shippingAddress);
      } else {
         // echo "else";
         $billingAddress['address_type'] = $shippingAddressType;
         OrderAddress::create($billingAddress);
      }
      Quote::where('cart_id', $cartId)->delete();
      QuoteItem::where('quote_id', $quotes->id)->delete();
      // OrderItem::
      return redirect()->route('checkout.success')->with('success', 'Order Placed successfully.!');
      // return back();
   }
   public function success()
   {
      return view('web.checksuccess');
   }
}
