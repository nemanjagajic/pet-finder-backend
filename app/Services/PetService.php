<?php

namespace App\Services;
use App\Constants\Constants;
use App\Pet;
use App\PetComment;


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

        $imageName = $petData->image
            ? $this->fileService->resizeAndSaveImage(
                $petData->image,
                Constants::IMAGE_WIDTH,
                Constants::IMAGE_HEIGHT
            )
            : '';

        $pet = new Pet();
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

    public function saveComment($commentData): PetComment
    {
        $commentData->validate([
           'petId' => 'required',
           'userId' => 'required',
           'content' => 'required'
        ]);

        $comment = new PetComment();
        $comment->pet_id = $commentData->petId;
        $comment->user_id = $commentData->userId;
        $comment->content = $commentData->content;

        if ($comment ->save()) {
            return $comment;
        }

        return null;
    }
}