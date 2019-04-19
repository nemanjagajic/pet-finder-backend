<?php

namespace App\Services;
use App\Pet;


class PetService
{
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function savePet($petData): Pet
    {
        $petData->validate([
            'userId' => 'required',
            'description' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $imageName = $petData->image ? $this->fileService->saveImage($petData->image) : '';

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