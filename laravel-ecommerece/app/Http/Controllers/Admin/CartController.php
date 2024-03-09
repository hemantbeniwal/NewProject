<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\QuoteItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        // dd($request->all());
        $attributeValue = json_encode(($request->attribute_value ?? []));
        $cartItem = $request->cart_item;
        $productId = $id;

        $productData = Product::find($id);
        $price = getProductPrice($id);

        $cart_id = Session::get('cart_id');

        if ($cart_id) {

            $quote = Quote::firstOrCreate(['cart_id' => $cart_id]);
            $quoteId = $quote->id;

            $quotesItem = QuoteItem::where('quote_id', $quoteId)->where('product_id', $productId)->first();

            if ($quotesItem) {
                QuoteItem::where('id', $quotesItem->id)->where('quote_id', $quoteId)->update([
                    'qty' => $cartItem + $quotesItem->qty
                ]);
            } else {
                // echo "New Data";
                QuoteItem::create([
                    'quote_id' => $quoteId,
                    'name' => $productData->name,
                    'sku' => $productData->sku,
                    'price' => $price,
                    'product_id' => $productId,
                    'custom_option' => $attributeValue,
                    'qty' => $cartItem,
                ]);
            }
        } else {
            $cart_id = Str::uuid()->toString();
            Session::put('cart_id', $cart_id);
            // echo $cart_id . "First time";


            $quoteData = Quote::create([
                'cart_id' => $cart_id,
                'name' => 'First'
            ]);

            $quote_id = $quoteData->id;

            QuoteItem::create([
                'quote_id' => $quote_id,
                'name' => $productData->name,
                'sku' => $productData->sku,
                'price' => $price,
                'product_id' => $productId,
                'custom_option' => $attributeValue,
                'qty' => $cartItem,
            ]);
        }

        recalculateCart();

        return redirect()->route('cart');
    }


    public function viewCart()
    {
        $cartId = Session::get('cart_id');
        $quotes = Quote::where('cart_id', $cartId)->first();

        return view('web.viewcart', compact('quotes'));
    }

    public function cartUpdate(Request $request, $id)
    {
        // dd($request->all());
         
        $quoteItem = QuoteItem::find($id);
        $qty = $request->qty;
        $rowTotal = $quoteItem->price * $qty;
        $data = [
            'qty' => $qty,
            'row_total' => $rowTotal,
        ];
        $quoteItemUpdate = QuoteItem::where('id', $id)->update($data);
        recalculateCart();
        return redirect()->back();
        // echo "this is cart page";
    }
    // cart delete method
    public function cartDelete(Request $request, $id)
    {
        $produtId = $request->produt_id;
        QuoteItem::where('id', $id)->where('product_id', $produtId)->delete();
        recalculateCart();
        return redirect()->back();
    }
    // apply coupon method
    public function couponApply(Request $request)
    {

        $couponCode = $request->coupon;
        $quotesId = $request->quotes_id;

        $cartId = Session::get('cart_id');
        $quote = Quote::where('cart_id', $cartId)->first();
        $couponData = Coupon::where('coupon_code', $couponCode)->where('status', 1)->first();
        if ($couponData) {
            if (($couponData->valid_from <= now()) && ($couponData->valid_to >= now()) &&  $couponData->discount_amount <= $quote->subtotal) {
                Quote::where('id', $quotesId)->update([
                    'coupon' => $couponData->coupon_code,
                    'coupon_discount' => $couponData->discount_amount
                ]);
            } else {
                return redirect()->back()->with('error', 'Coupon has been expired.');
            }

            recalculateCart();
            return redirect()->back()->with('success', 'Coupon Applied successfully.');
        }else{
            return redirect()->back()->with('error', 'Coupon Not Applicable.');
        }
    }
    public function couponCancel($id)
    {
        $quote = Quote::where('id', $id)->first();
        $total = $quote->subtotal;
        $quoteUpdate = Quote::where('id', $id)->update([
            'coupon'          => null,
            'coupon_discount' => null,
            'total'           => $total
        ]);
        recalculateCart();
        return redirect()->back()->with('success', 'Coupon removed successfully');
    }
}
