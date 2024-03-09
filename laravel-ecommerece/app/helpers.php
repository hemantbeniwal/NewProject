<?php

use App\Models\Attribute;
use App\Models\Block;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\Quote;
use App\Models\Order;
use App\Models\QuoteItem;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

if (!function_exists('generateUniqueUrlKey')) {
    function generateUniqueUrlKey($name)
    {
        $baseSlug = Str::slug($name);
        $urlKey = $baseSlug;
        $counter = 1;

        // Check if the URL key already exists
        while (urlKeyExists($urlKey)) {
            $urlKey = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $urlKey;
    }
}

if (!function_exists('urlKeyExists')) {
    function urlKeyExists($urlKey)
    {
        // Assuming Product is your model name
        return \App\Models\Page::where('url_key', $urlKey)->exists();
    }
}



if (!function_exists('generateUniqueidentifier')) {
    function generateUniqueidentifier($name)
    {
        $baseSlug = Str::slug($name);
        $identifier = $baseSlug;
        $counter = 1;

        // Check if the URL key already exists
        while (identifierExists($identifier)) {
            $identifier = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $identifier;
    }
}

if (!function_exists('identifierExists')) {
    function identifierExists($identifier)
    {
        // Assuming Product is your model name
        return \App\Models\Block::where('identifier', $identifier)->exists();
    }
}


function getpages()
{
    $pages = Page::where('status', 1)->where('parent_id', 0)->orderBy('ordering')->get();

    return $pages;
}

function getSubPages($id)
{
    $subPages = Page::where('parent_id', $id)->get();
    return $subPages;
}
function getCategory()
{
    $subcategory = Category::where('category_parent_id', 0)->get();
    return $subcategory;
}
function getsubCategory($id)
{
    $subcategorys = Category::where('category_parent_id', $id)->get();
    return $subcategorys;
}
function getsubsubCategory($id)
{
    $subcategorys = Category::where('category_parent_id', $id)->get();
    return $subcategorys;
}
function getCategories()
{
    $catagory = Category::where('category_parent_id', 0)->where('status', 1)->get();
    return $catagory;
}
// function getproducts()
// {
//     $product = Product::where('status', 1)->get();
//     // $product->paginate(3);
//     return $product;
// }
function getblock()
{
    $block = Block::where('status', 1)->get();
    return $block;
}
function getattribute()
{
    $attributes = Attribute::with('attribute_value')->get();
    return $attributes;
}

function getfeatured()
{
    $is_featured = Product::where('is_featured', 1)->get();
    return $is_featured;
}


// cart related
function getRelatedProduct($pIds){
$pId = explode(',',$pIds);
    $relatedproduct = Product::whereIn('id',$pId)->get();
    return $relatedproduct;
}
function getProductPrice($id)
{

    $todayDate = Carbon\Carbon::now();

    $product = Product::find($id);

    if (($todayDate >= $product->special_price_from) && ($todayDate <= $product->special_price_to) and ($product->special_price)) {
        return $product->special_price;
    } else {
        return $product->price;
    }
    // echo $mytime->toDateTimeString();

}
function cartSummaryCount()
{
    $cartId = Session::get('cart_id');
    if ($cartId) {
        $quote = Quote::where('cart_id', $cartId)->first();
        return ($quote->quoteItems ?? 0) ? $quote->quoteItems->count() : 0;
    } else {
        return 0;
    }
}
function WishlistSummaryCount()
{
    $userId = Auth::user()->id ?? 0;
    $wishId = Wishlist::where('user_id',$userId)->get();

    $countwishlist = $wishId->count();
    return $countwishlist;
    
}


function recalculateCart()
{
    $cartId = Session::get('cart_id');
    $quote = Quote::where('cart_id', $cartId)->first();
    $quotesItems = $quote->quoteItems;

    foreach ($quotesItems as $item) {
        $item->row_total = $item->qty * $item->price;
        $item->save();
        // echo $item;
    }


    $quote->subtotal = $quote->quoteItems->sum('row_total');
    if ($quote->subtotal > $quote->coupon_discount) {
        $quote->total = $quote->subtotal - $quote->coupon_discount;
    } else {
        $quote->total = $quote->subtotal;
        $quote->coupon = null;
        $quote->coupon_discount = 0;
    }
    $quote->save();
}

function getProductSpecialPrice($pId)
{
    $todayDate = Carbon\Carbon::now();
    $product = Product::find($pId);
    if (($product->special_price_from <= $todayDate) && ($product->special_price_to >= $todayDate)) {
?>
        <h3 class="font-weight-semi-bold mb-4" style="float:left; margin-right:10px;">
            ₹<?= $product->special_price ?></h3>
        <h4 class="font-weight-semi-bold mb-4"><del>₹<?= $product->price ?></del></h4>
    <?php

    } else {
        // return $product->price;
    ?>
        <h4 class="font-weight-semi-bold mb-4">₹<?= $product->price ?></h4>
<?php
    }
    return;
}
function productImage($pId)
{
    $product = Product::find($pId);
    return $product->getFirstMediaUrl('thumbnail_image');
}
function successOrder()
    {
        $order = Order::orderBy('id','desc')->first();
        return $order;
        
    }
function reActiveCart($userId){
    $cartId = Session::get('cart_id');

    if($cartId){
        Quote::where('cart_id',$cartId)->update([
            'user_id'=>$userId
        ]);
    }

    if($cartId){
        $quoteOld=Quote::where('user_id',$userId)->where('cart_id','!=',$cartId)->first();
        if($quoteOld){
            $newQuote=Quote::where('user_id',$userId)->where('cart_id',$cartId)->first();
            $quortId=$newQuote->id??0;

            QuoteItem::where('quote_id', $quoteOld->id)->update(['quote_id'=>$quortId]);
            $quoteOld->delete();

        }
    }else{
        $quote=Quote::where('user_id',$userId)->first();
        if($quote){
           $cartId= $quote->cart_id;
           session::put('cart_id',$cartId);
        }
    }
}

?>