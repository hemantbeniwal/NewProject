<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;


class stateContruller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $states = State::all();
        // dd($states); 
        return view('state.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $countrydata = Country::all();

        // dd($countrydata);
        return view('state.create', compact('countrydata'));
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
        $states = State::create($data);
        $countryId = $request->country_id;
        $stateId = $states->id;
        $cityName = $request->city_name;
        $city_status = $request->city_status;
        // dd($data);
        foreach ($cityName as $key => $_city_name) {
            $status_name = $city_status[$key];
            City::create(
                [
                    "country_id" => $countryId,
                    "state_id" => $stateId,
                    "city_name" => $_city_name,
                    "city_status" => $status_name
                ]
            );
        }


        return redirect()->route('state.index');
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
        $country = Country::all();
        // dd($country);
        $state = State::find($id);
        // $city = City::select('id','city_name','city_status')->where('state_id',$id)->get();

        // dd($city);
        return view('state.edit', compact('state', 'country'));
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
        // $dtat = $request->all();
        // dd($dtat);
        State::where('id', $id)->update([
            'state' => $request->state,
            'status' => $request->status,
            'country_id' => $request->country_id
        ]);
        $cityId = $request->city_id;
        if(empty($cityId)){
            City::where('id',$id)->delete();
        }else{
            City::whereNotIn('id',$cityId)->where('state_id',$id)->delete();
        }
        $cityName = $request->city_name;
        $cityStatus = $request->city_status;
        $countryId = $request->country_id;
        // dd($cityId);
        foreach($cityName as $key => $_city){
            $ctId = $cityId[$key]??0;
            if($ctId){
            City::where('id',$ctId)->Update([
                'country_id'=>$countryId,
                'city_name'=>$_city,
                'city_status'=>$cityStatus[$key]
            ]);
          } else
        {
            City::create([
                'country_id' => $countryId,
                'state_id' => $id,
                'city_name' => $_city,
                'city_status'=> $cityStatus[$key]
            ]);
        }
        }


        return redirect()->route('state.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public  function destroy($id)
    public function destroy($id)
    {

        State::where('id', $id)->delete();
        return redirect()->route('state.index');
    }
}
