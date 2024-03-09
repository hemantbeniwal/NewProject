<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Attribute_value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('attribute_index'), 403);

        $attribute = Attribute::all();
        return view('admin.attribute.index', compact('attribute'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('attribute_create'), 403);

        return view('admin.attribute.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $attribute = $request->all();
        // dd($attribute);
        $request->validate([
            'name' => 'required',
            'is_variant' => 'required',
            'status' => 'required',
        ]);
        $name = $request->url_key ? $request->url_key : $request->name;
        // dd($name);
        $urlKey = generateUniqueUrlKey($name);
        $attributes = Attribute::create([
            'name' => $request->name,
            'is_variant' => $request->is_variant,
            'name_key' => $urlKey,
            'status' => $request->status
        ]);
        $attribute_id = $attributes->id;
        $attriName = $request->attribute_name;
        $attriStatus = $request->attribute_status;
        if($attriName)
        foreach ($attriName as $key => $_attriname) {
            Attribute_value::create([
                'attribute_id' => $attribute_id,
                'name' => $_attriname,
                'status' => $attriStatus[$key]
            ]);
        }
        if ($request->save) {
            return redirect()->route('attribute.index')->withSuccess('Data Save successfully');
        } else {
            return redirect()->back()->withSuccess('Data Save successfully');
        }
        // dd($attriId);
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
        abort_unless(Gate::allows('attribute_edit'), 403);

        $attribute = Attribute::find($id);
        // $attributeValue = Attribute_value::all();
        // dd($attributeValue);
        return view('admin.attribute.edit', compact('attribute',));
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
        // $aatri = $request->all();
        // dd($aatri);
        $request->validate([
            'name' => 'required',
            'is_variant' => 'required',
            'status' => 'required',
        ]);
        $name = $request->url_key ? $request->url_key : $request->name;
        $urlKey = generateUniqueUrlKey($name);
        $attributes = Attribute::where('id', $id)->update([
            'name' => $request->name,
            'is_variant' => $request->is_variant,
            'name_key' => $urlKey,
            'status' => $request->status
        ]);

        $attri_id = $request->atri;
        if (empty($attri_id)) {
            Attribute_value::where('attribute_id', $id)->delete();
        } else {
            Attribute_value::whereNotIn('id', $attri_id)->where('attribute_id', $id)->delete();
        }
        $attriName = $request->attribute_name;
        $attriStatus = $request->attribute_status;
        if(!empty($attriName))
        foreach ($attriName as $key => $_attriname) {
            $atti_Id = $attri_id[$key] ?? 0;
            if ($atti_Id) {
                Attribute_value::where('id', $atti_Id)->update([
                    'name' => $_attriname,
                    'status' => $attriStatus[$key]
                ]);
            } else {
                Attribute_value::create([
                    'attribute_id' => $id,
                    'name' => $_attriname,
                    'status' => $attriStatus[$key]
                ]);
            }
        }
        return redirect()->route('attribute.index')->withSuccess('Data Save successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Attribute::where('id', $id)->delete();
        Attribute_value::where('attribute_id', $id)->delete();
        return redirect()->route('attribute.index')->withSuccess('Data Deleted successfully');
    }
}
