<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $country = Country::all();
        // dd($country);
        return view('country.index', compact('country'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        // dd($data);
        $country = Country::create($data);
        $countryId = $country->id;
        // ---------End country----------
        $state_name =$request->state_name;
        $state_status =$request->state_status;
    
        // dd($state_name);
        foreach($state_name as $key =>$_state ){
                $_status =  $state_status[$key];
                // dd($_status);
        State::create(["country_id"=>$countryId,
                        "state"=>$_state,
                        "status"=>$_status
                    ]);
                };
        return redirect()->route('country.index');
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
        //
        $country = Country::find($id);
        // $country = Country::where('id', $id)->with('states')->first();
        // dd($country);
        //$states = State::where('country_id',$id)->get();

        // dd($states);
        return view('country.edit', compact('country'));
        // dd($id);
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
        //
        // $data = $request->except('_token','_method');
        // dd($data);
        $country= Country::where('id',$id)->update([
            'name'=>$request->name,
            'status'=>$request->status
        ]);
        
        $stateId = $request->state_id;
        if(empty($stateId)){
            State::where('state_id',$id)->delete();
        }else{
            State::whereNotIn('id',$stateId)->where('country_id',$id)->delete();
        }
        $stateName = $request->state_name;
        $statestatus = $request->state_status;
        // dd($stateId);
        foreach($stateName as $key => $_statName){
            $stId = $stateId[$key]??0;
            // dd($stId);
            if($stId){

                State::where('id',$stId)->update([
                    'state'=>$_statName,
                    'status'=>$statestatus[$key]
                ]);
                // dd($states);
            } else{
                State::create([ 
                        "country_id"=>$id,
                        'state'=>$_statName,
                        'status'=>$statestatus[$key],
                        // 'country_id'=>$id
            ]);
            }
        }
        return redirect()->route('country.index');
        // dd($country);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Country::where('id',$id)->delete();
        State::where('country_id',$id)->delete();
        return redirect()->route('country.index');
        //
    }
    public function getState(Request $request){
        $countryId = $request->ct_id;
        $states = State::where('country_id',$countryId)->get();
        foreach($states as $state){
            echo "<option value='{$state->id}'>$state->state</option>";
        }
    }
}
