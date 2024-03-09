<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Page;
use Illuminate\Support\Facades\Gate;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('page_index'), 403);
        $page = Page::where('parent_id',0)->get();
        return view('admin.page.index', compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('page_create'), 403);
        $page = Page::all();
        return view('admin.page.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'ordering' => 'required',
            'status' => 'required',
        ]);

        $name = $request->url_key ? $request->url_key : $request->title;
        $urlKey = generateUniqueUrlKey($name);
        // dd($urlKey);

        $page = Page::create([
            'title' => $request->title,
            'heading' => $request->heading,
            'ordering' => $request->ordering,
            'status' => $request->status,
            'description' => $request->description,
            'url_key' => $urlKey,
            'parent_id' => $request->parent_id ?? 0
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $page->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return redirect()->route('page.index')->withSuccess('Page add successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('page_edit'), 403);
        $page = Page::find($id);
        
        return view('admin.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
        
        $data = $request->validate([
            'title' => 'required',
            'ordering' => 'required',
            'status' => 'required',
        ]);

        // $name = $request->url_key ? $request->url_key : $request->title;
        // $urlKey = generateUniqueUrlKey($name);

        $page = Page::findOrFail($id);


        $page->update([
            'title' => $request->title,
            'heading' => $request->heading,
            'ordering' => $request->ordering,
            'status' => $request->status,
            'description' => $request->description,
            // 'url_key' => $urlKey,
            'parent_id' => $request->parent_id ?? 0

        ]);

        if ($request->hasFile('image')) {
            $page->clearMediaCollection('image');
            $page->addMedia($request->file('image'))->toMediaCollection('image');
        }

        return redirect()->route('page.index')->withSuccess('Page update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Page::where('id', $id)->delete();
        return redirect()->back()->withSuccess('Page deleted successfully.');
    }

    public function upload(Request $request)
    {

        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' . $fileName);

            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}