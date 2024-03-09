<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Gate;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('slider_index'), 403);

        $slider = Slider::all();

        return view('admin.slider.index',compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('slider_create'), 403);

        return view('admin.slider.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider = $request->validate([
            'title'=>'required',
            'ordering'=>'required',
            'status'=>'required',
        ]);
       $sliders = Slider::create($slider);
       if($request->hasFile('image') && $request->file('image')->isValid()){
        $sliders->addMediaFromRequest('image')->toMediaCollection('image');
    }
        return redirect()->route('slider.index')->withSuccess('Data Add Successfully');
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
        abort_unless(Gate::allows('slider_edit'), 403);

        $slider = Slider::find($id);
        return view('admin.slider.edit',compact('slider'));

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
        $slider = $request->validate([
            'title'=>'required',
            'ordering'=>'required',
            'status'=>'required',
        ]);
       $sliders =  Slider::findOrfail($id);
        $sliders->update($slider);
        if($request->hasFile('image')){
            $sliders->clearMediaCollection('image');
            $sliders->addMedia($request->file('image'))->toMediaCollection('image');
        }
        return redirect()->route('slider.index')->withSuccess('Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sliders =Slider::findOrFail($id);
        $sliders->delete();
        $sliders->getFirstMediaUrl($id);
        return redirect()->route('slider.index')->withSuccess('Data Deleted Successfully');
    }
}
