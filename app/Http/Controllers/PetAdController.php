<?php

namespace App\Http\Controllers;

use App\PetAd;
use App\Services\PetAdService;
use Illuminate\Http\Request;

class PetAdController extends Controller
{
    private $petAdService;

    public function __construct(PetAdService $petAdService)
    {
        $this->petAdService = $petAdService;
    }


    public function index()
    {
        return response(PetAd::get());
    }


    public function getLostPets() {
        return response(PetAd::where('type', 1)->get());
    }


    public function getAdoptingPets() {
        return response(PetAd::where('type', 2)->get());
    }


    public function store(Request $request)
    {
        $petAd = $this->petAdService->savePetAd($request);

        if ($petAd !== null) {
            return response($petAd, 200);
        }
    }
}
