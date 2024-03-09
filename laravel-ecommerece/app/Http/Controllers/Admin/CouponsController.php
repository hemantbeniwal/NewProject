<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('coupon_index'), 403);

        $coupons = Coupon::all();
        return view('admin.coupon.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('coupon_create'), 403);

        return view('admin.coupon.create');
        
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
            'title' => 'required|string|max:255',
            'status' => 'required',
            'coupon_code' => 'required|string|unique:coupons,coupon_code|max:255',
            'valid_from' => 'required',
            'valid_to' => 'required',
            'discount_amount' => 'required|numeric|min:0',
        ]);
        Coupon::create($request->all());
        return redirect()->route('coupon.index')->withSuccess('Data Save Successfully');
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
        abort_unless(Gate::allows('coupon_edit'), 403);

        $coupons = Coupon::find($id);
        return view('admin.coupon.edit',compact('coupons'));
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
            'title' => 'required|string|max:255',
            'status' => 'required',
            'coupon_code' => 'required',
            'valid_from' => 'required',
            'valid_to' => 'required',
            'discount_amount' => 'required|numeric|min:0',
        ]);
        $data = $request->all();
        $data = $request->except('_token','_method');
       $coupon =  Coupon::where('id',$id);
       $coupon->update($data);
       return redirect()->route('coupon.index')->withSuccess('Data Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Coupon::where('id', $id)->delete();
        return redirect()->route('coupon.index')->withSuccess('Data Deleted Successfully');
    }
}
