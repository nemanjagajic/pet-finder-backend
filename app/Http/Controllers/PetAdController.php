<?php

namespace App\Http\Controllers;

use App\PetAd;
use App\Services\PetAdService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function getLostPets() {
        return PetAd::where('type', 1)->get();
    }

    public function getAdoptingPets() {
        return PetAd::where('type', 2)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $petAd = PetAdService::savePetAd($request);

        if ($petAd !== null) {
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
