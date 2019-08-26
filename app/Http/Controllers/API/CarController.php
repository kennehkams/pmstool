<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\car;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Car::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'fuel' => 'required',
            'registration' => 'required',            
            'year' => 'required',
            'capacity' => 'required',
            'priceperkm' => 'required'

        ]);

        return Car::create([            
            'name' => $request['name'],
            'fuel' => $request['fuel'],
            'registration' => $request['registration'],            
            'year' => $request['year'],
            'capacity' => $request['capacity'],
            'priceperkm' => $request['priceperkm']
        ]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = user::findOrFail($id);

        $this->validate($request,[
            'name' => 'required',
            'fuel' => 'required',
            'registration' => 'required',            
            'year' => 'required',
            'capacity' => 'required',
            'priceperkm' => 'required'
        ]);       

        $user->update($request->all());

        return ['message' => 'Updated the car info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return ['message' => 'User Deleted'];
    }
}
