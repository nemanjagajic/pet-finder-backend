<?php

namespace App\Services;
use App\PetAd;
use Illuminate\Support\Facades\Storage;


class PetAdService
{
    public static function savePetAd($petAdData): PetAd
    {
        $petAdData->validate([
            'userId' => 'required',
            'description' => 'required',
            'locationInfo' => 'required',
            'phoneNumber' => 'required'
        ]);

        $imageName = FileService::saveImage($petAdData->image);

        $petAd = new PetAd;
        $petAd->image = $imageName;
        $petAd->userId = $petAdData->userId;
        $petAd->description = $petAdData->description;
        $petAd->locationInfo = $petAdData->locationInfo;
        $petAd->phoneNumber = $petAdData->phoneNumber;
        $petAd->type = $petAdData->type;

        if ($petAd->save()) {
            return $petAd;
        }

        return null;
    }
}