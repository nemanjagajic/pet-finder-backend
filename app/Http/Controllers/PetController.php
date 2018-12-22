<?php

namespace App\Http\Controllers;

use App\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Pet::get();
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
            'userId' => 'required',
            'description' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $pet = new Pet;
        $pet->image = $request->image;
        $pet->userId = $request->userId;
        $pet->description = $request->description;
        $pet->latitude = $request->latitude;
        $pet->longitude =  $request->longitude;
        $pet->street = $request->street;
        $pet->name = $request->name;
        $pet->country = $request->country;
        $pet->city = $request->city;

        if ($pet->save()) {
            return response($pet, 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pet $pet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        //
    }
}
