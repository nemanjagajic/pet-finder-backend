<?php

namespace App\Services;
use App\Pet;


class PetService
{
    public static function savePet($petData): Pet
    {
        $petData->validate([
            'userId' => 'required',
            'description' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $imageName = FileService::saveImage($petData->image);

        $pet = new Pet;
        $pet->image = $imageName;
        $pet->userId = $petData->userId;
        $pet->description = $petData->description;
        $pet->latitude = $petData->latitude;
        $pet->longitude =  $petData->longitude;
        $pet->street = $petData->street;
        $pet->name = $petData->name;
        $pet->country = $petData->country;
        $pet->city = $petData->city;

        if ($pet->save()) {
            return $pet;
        }

        return null;
    }
}