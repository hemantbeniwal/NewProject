<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('category_index'), 403);

        $category = Category::all();
        return view('admin.category.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('category_create'), 403);

        $product = Product::all();
        return view('admin.category.create',compact('product'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = $request->image;
        // dd($data);
        $request->validate([
        'name'=>'required',
        'status'=>'required',
        'show_in_menu'=>'required',
        'description'=>'required',
        'meta_tag'=>'required',
        'meta_title'=>'required',
        'meta_description'=>'required'
        ]);
        $category = $request->all();
        // dd($category);
        $categorys = $request->url_key ? $request->url_key : $request->name;
        $category['url_key'] = generateUniqueUrlKey($categorys);
        $category['category_parent_id'] = $request->category_parent_id ?? 0;
           $category = Category::create($category);
            if($request->hasFile('image') && $images = $request->file('image')){
                foreach($images as $image){

                    $category->addMedia($image)->toMediaCollection('image');
                }
            }
            if($request->hasFile('thumbnail_image') && $request->file('thumbnail_image')->isValid()){
                $category->addMediaFromRequest('thumbnail_image')->toMediaCollection('thumbnail_image');
            }
        
           if($request->has('products')){
            $category->products()->sync($request->input('products'));

           }
            if($request->save){
                return redirect()->route('category.index')->withSuccess('Data Save successfully');
            }else{
                return redirect()->back()->withSuccess('Data Save successfully');
            }
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
        abort_unless(Gate::allows('category_edit'), 403);

        $category = Category::find($id);
        $products = Product::all();
        return view('admin.category.edit',compact('category','products'));
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
        'show_in_menu'=>'required',
        'description'=>'required',
        'meta_tag'=>'required',
        'meta_title'=>'required',
        'meta_description'=>'required'
        ]);
        $category = $request->all();
        // dd($category);
        $category = $request->except('_token','_method');
        // dd($category);
       $categoryData =  Category::findOrFail($id);
       $categoryData->update($category);
        // dd($category_id);
        if($request->hasFile('image') && $images = $request->file('image')){
            $categoryData->clearMediaCollection('image');
            foreach($images as $image) {
            $categoryData->addMediaFromRequest('image')->toMediaCollection('image');
            }
        }      
        if($request->hasFile('thumbnail_image') &&  $request->file('thumbnail_image')) {
            
                $categoryData->addMedia($image)->toMediaCollection('thumbnail_image');
            
        }
        if($request->has('products')){
            $categoryData->products()->sync($request->input('products'));
        }
        return redirect()->route('category.index')->withSuccess('Data Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $catgory = Category::findOrfail($id);
        $catgory->delete();
        $catgory->getFirstMediaUrl($id);
        
        return redirect()->back()->withSuccess('Data deleted successfully.');
    }
}
