<?php

namespace App\Http\Controllers;

use App\PetAd;
use App\Services\PetAdService;
use Illuminate\Http\Request;
use App\User;


class PetAdController extends Controller
{
    private $petAdService;

    public function __construct(PetAdService $petAdService)
    {
        $this->petAdService = $petAdService;
    }


    public function index()
    {
        $petAds = PetAd::get();

        $petAdsReversed = [];
        foreach ($petAds as $petAd) {
            $petAd->fullName = User::where('id', $petAd->userId)->get()->pluck('fullName')[0];
            array_unshift($petAdsReversed, $petAd);
        }

        return response($petAdsReversed);
    }


    public function getLostPets() {
        $petAds = PetAd::where('type', 1)->get();

        $petAdsReversed = [];
        foreach ($petAds as $petAd) {
            $petAd->fullName = User::where('id', $petAd->userId)->get()->pluck('fullName')[0];
            array_unshift($petAdsReversed, $petAd);
        }

        return response($petAdsReversed);
    }


    public function getAdoptingPets() {
        $petAds = PetAd::where('type', 2)->get();

        $petAdsReversed = [];
        foreach ($petAds as $petAd) {
            $petAd->fullName = User::where('id', $petAd->userId)->get()->pluck('fullName')[0];
            array_unshift($petAdsReversed, $petAd);
        }

        return response($petAdsReversed);
    }


    public function store(Request $request)
    {
        $petAd = $this->petAdService->savePetAd($request);

        if ($petAd !== null) {
            return response($petAd, 200);
        }
    }

    public function getComments($id)
    {
        $comments = PetAd::find($id)->comments;

        $reverserComments = [];
        foreach ($comments as $comment) {
            $comment->fullName = User::where('id', $comment->user_id)->get()->pluck('fullName')[0];
            array_unshift($reverserComments, $comment);
        }

        return response($reverserComments);
    }
}
