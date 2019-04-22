<?php

namespace App\Services;
use App\PetAd;
use App\PetAdComment;
use Illuminate\Support\Facades\Storage;


class PetAdService
{
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function savePetAd($petAdData): PetAd
    {
        $petAdData->validate([
            'userId' => 'required',
            'description' => 'required',
            'locationInfo' => 'required',
            'phoneNumber' => 'required'
        ]);

        $imageName = $petAdData->image ? $this->fileService->saveImage($petAdData->image) : '';

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

    public function saveComment($commentData): PetAdComment
    {
        $commentData->validate([
            'petAdId' => 'required',
            'content' => 'required'
        ]);

        $comment = new PetAdComment();
        $comment->content = $commentData->content;
        $comment->pet_ad_id = $commentData->petAdId;

        if ($comment ->save()) {
            return $comment;
        }

        return null;
    }
}