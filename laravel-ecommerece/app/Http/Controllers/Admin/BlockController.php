<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Block;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('block_index'), 403);

        $block = Block::all();
        return view('admin.block.index',compact('block'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('block_create'), 403);

        return view('admin.block.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $block = $request->validate([
            'identifier'=>'required',
            'title'=>'required',
            'heading'=>'required',
            'ordering'=>'required',
            'status'=>'required',
            'description'=>'required',
        ]);
       $blocks = Block::create($block);
       if($request->hasFile('image') && $request->file('image')->isValid()){
        $blocks->addMediaFromRequest('image')->toMediaCollection('image');
    }
        return redirect()->route('block.index')->withSuccess('Data Add Successfully');
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
        
        abort_unless(Gate::allows('block_edit'), 403);

        $block = Block::find($id);
        return view('admin.block.edit',compact('block'));
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
        $block = $request->validate([
            'identifier'=>'required',
            'title'=>'required',
            'heading'=>'required',
            'ordering'=>'required',
            'status'=>'required',
            'description'=>'required',
        ]);
        $blocks = Block::findOrfail($id);
        $blocks->update($block);
        if($request->hasFile('image')){
            $blocks->clearMediaCollection('image');
            $blocks->addMedia($request->file('image'))->toMediaCollection('image');
        }
        return redirect()->route('block.index')->withSuccess('Data Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $blocks =  Block::findOrFail($id);
        $blocks->delete();
        $blocks->getFirstMediaUrl($id);
        return redirect()->route('block.index')->withSuccess('Data Deleted Successfully');

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
