<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('product_index'), 403);
        
        $product = Product::all();
        return view('admin.product.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('product_create'), 403);

        $category = Category::all();
        $products = Product::all();
        // dd($category); 
        return view('admin.product.create',compact('category','products'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'status'=>'required',
            'is_featured'=>'required',
            'sku' => 'required|unique:products,sku',
            'qty'=>'required',
            'stock_status'=>'required',
            'weight'=>'required',
            'price'=>'required',
            'short_description'=>'required',
            'description'=>'required',
        ]);
        $product = $request->all();
        // dd($product);
        $url_key = $request->url_key ? $request->url_key : $request->name;
        $product['url_key'] = generateUniqueUrlKey($url_key);
        $product['related_product'] = implode(', ', $product['related_product'] ?? []);

        $products = Product::create($product);
        $category_id = $request->has('categories');
        if($request->hasFile('image') && $images = $request->file('image')){
            foreach($images as $image){

                $products->addMedia($image)->toMediaCollection('image');
            }
        }
        if($request->hasFile('thumbnail_image') && $request->file('thumbnail_image')->isValid()){
            $products->addMediaFromRequest('thumbnail_image')->toMediaCollection('thumbnail_image');
        }
        if($category_id){
            $products->categories()->sync($request->input('categories'));
        }

        $attribute=$request->input('attribute');
        $value=$request->input('value');
        foreach ($attribute as $key => $_atr) {
            foreach ($value[$_atr] as $key => $_value) {
                $data=[
                    'product_id'=>$products->id,
                    'attribute_id'=>$_atr,
                    'attribute_value_id' =>$_value,
                ];
                ProductAttribute::create($data);
            }
        }

        if($request->save){
            return redirect()->route('product.index')->withSuccess('Data Save successfully');

        }else{
            return redirect()->back()->withSuccess('Data Save successfully');
        }

        // dd($product);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(Gate::allows('product_edit'), 403);

        $product = Product::findorfail($id);
        $categories = Category::all();
        $relatedProducts = Product::all();
        $productAtt= ProductAttribute::where('product_id',$id)->pluck('attribute_value_id')->toArray();
        // dd($productAtt);
        return view('admin.product.edit',compact('product','categories','relatedProducts','productAtt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'status'=>'required',
            'is_featured'=>'required',
            'sku' => 'required',
            'qty'=>'required',
            'stock_status'=>'required',
            'weight'=>'required',
            'price'=>'required',
            'short_description'=>'required',
            'description'=>'required',
        ]);
        $product = $request->all();
        // dd($product);
        $product = $request->except('_token', '_method');
        $url_key = $request->url_key ? $request->url_key : $request->name;
        $product['url_key'] = generateUniqueUrlKey($url_key);
        $product['related_product'] = implode(', ', $product['related_product'] ?? []);

      $products =  Product::findOrfail($id);
      $products->update($product);
        // dd($category_id);
        $attribute = $request->input('attribute');
        $value = $request->input('value');
        ProductAttribute::where('product_id',$products->id)->delete();
        foreach ($attribute as $key => $att_id) {
            foreach ($value[$att_id] as $key => $value_id) {
                $data = [
                    'product_id' => $products->id,
                    'attribute_id' => $att_id,
                    'attribute_value_id' => $value_id,
                ];
                ProductAttribute::create($data);
            }
        }
        if($request->hasFile('thumbnail_image') && $request->file('thumbnail_image')->isValid()){
            $products->clearMediaCollection('thumbnail_image');
            $products->addMediaFromRequest('thumbnail_image')->toMediaCollection('thumbnail_image');
        }      
        if($request->hasFile('image') && $images = $request->file('image')) {
            foreach($images as $image) {
                $products->addMedia($image)->toMediaCollection('image');
            }
        }
        if($request->has('categories')){
            $products->categories()->sync($request->input('categories'));
        }
        return redirect()->route('product.index')->withSuccess('Data Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrfail($id);
        $product->delete();
        $product->getFirstMediaUrl($id);

        return redirect()->back()->withSuccess('Data Deleted Successfully');
    }
    public function upload(Request $request): JsonResponse
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
      
            $request->file('upload')->move(public_path('media'), $fileName);
      
            $url = asset('media/' . $fileName);
  
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }
}
