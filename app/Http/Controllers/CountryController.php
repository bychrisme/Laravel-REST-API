<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Country;
use App\Models\Continent;
use Validator;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Country::get(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'continent' => 'required',
            'name' => 'required',
            'code' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $continent = Continent::find($request['continent']);
        $country = new Country();
        $country->name = $request['name'];
        $country->code =  $request['code'];
        $continent->countries()->save($country);
        return response()->json($country, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = Country::find($id);
        if(is_null($country)){
            return response()->json('Data not found', 404);
        }
        $country->continent;
        return response()->json($country, 200);
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
        $country = Country::find($id);
        if(is_null($country)){
            return response()->json('Data not found', 404);
        }
        $continent = Continent::find($request['continent']);
        if(!$continent && $request['continent']){
            return response()->json("continent doesn't exists", 404);
        }
        $country->continent()->associate($continent);
        $country->update($request->all());
        return response()->json($country, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::find($id);
        if(is_null($country)){
            return response()->json('Data not found', 404);
        }
        $country->delete();
        return response()->json(null, 204);
    }

    public function updateContinent(Request $request, $id){
        $country = Country::find($id);
        if(is_null($country)){
            return response()->json('Data not found', 404);
        }
        $country->continent()->associate(Continent::find($continent));
        $country->save();
    }
}
