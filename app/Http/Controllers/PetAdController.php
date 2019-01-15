<?php

namespace App\Http\Controllers;

use App\PetAd;
use Illuminate\Http\Request;

class PetAdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PetAd::get();
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
            'locationInfo' => 'required',
            'phoneNumber' => 'required'
        ]);

        $petAd = new PetAd;
        $petAd->image = $request->image;
        $petAd->userId = $request->userId;
        $petAd->description = $request->description;
        $petAd->locationInfo = $request->locationInfo;
        $petAd->phoneNumber = $request->phoneNumber;

        if ($petAd->save()) {
            return response($petAd, 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PetAd  $petAd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PetAd $petAd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PetAd  $petAd
     * @return \Illuminate\Http\Response
     */
    public function destroy(PetAd $petAd)
    {
        //
    }
}
