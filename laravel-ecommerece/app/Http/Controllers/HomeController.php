<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Block;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Attribute;
use App\Models\Attribute_value;

class HomeController extends Controller
{
    public function index(){
        $blocks=Block::all();
        // dd($blocks);
        $sliders=Slider::all();
        $products = Product::where('status', 1)->simplePaginate(4);
        // dd($products);
        // $products->paginate(3);
        return view('web.home',compact('blocks','sliders','products'));
    }
    public function page($urlKey){
        $page = Page::where('url_key',$urlKey)->where('status',1)->first();
        // dd($page);
        return view('web.page',compact('page'));
    }
    public function categories($urlKey){
        $category = Category::where('url_key',$urlKey)->where('status',1)->first();
        return view('web.category',compact('category'));
    }
    public function product($urlKey){
        $product = Product::where('url_key',$urlKey)->where('status',1)->first();
        return view('web.product',compact('product'));
    }
    public function productData($url_key)
    {
        // dd($url_key);
        $product = Product::where('url_key', $url_key)->first();
        // dd($product);
        $productAttributes = ProductAttribute::where('product_id', $product->id)->get();
        $attributes = [];

        foreach ($productAttributes as $productAttribute) {
            $attributeId = $productAttribute->attribute_id;
            $attributeValueId = $productAttribute->attribute_value_id;
            $attribute = Attribute::find($attributeId);
            $attributeValue = Attribute_value::find($attributeValueId);

            if ($attribute && $attributeValue) {
                if (!isset($attributes[$attribute->name])) {
                    $attributes[$attribute->name] = [];
                }
                $attributes[$attribute->name][] = $attributeValue;
            }
        }
        // dd($product);
        // $product->paginate(1);
        // dd($attributes);

        if ($product) {
            return view('web.product', compact('product', 'attributes'));
        } else {
            abort(403);
        }
    }
}
