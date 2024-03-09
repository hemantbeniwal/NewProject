<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate ;
class EnquiryController extends Controller
{
    public function index(){
        abort_unless(Gate::allows('enquiry'), 403);

        $enquiry = Enquiry::all();
        return view('admin.enquiry',compact('enquiry'));
    }
    public function store(Request $request){
        $data = $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'status'=>'required',
            'message'=>'required',
        ]);
        // dd($data);
        Enquiry::create($data);
        return back();
    }
    public function status(Request $request){
        $enqId = $request->enqueryId;
      Enquiry::where("id",$enqId)->update(["status"=>2]);
      echo '<button class="btn btn-success">Read</button>';

    } 

    public function destroy($id){
        //  Enquiry::where('id',$id)->delete();
        $enqData = Enquiry::findOrfail($id);
        // dd($enqData);
        $enqData->delete();
        return back();
    }
}
