<?php

namespace App\Services;
use App\Constants\Constants;
use App\Constants\PathConstants;
use App\PetAd;
use App\PetAdComment;


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

        $imageName = $petAdData->image
            ? $this->fileService->resizeAndSaveImage(
                PathConstants::PETS_PATH,
                $petAdData->image,
                Constants::IMAGE_WIDTH,
                Constants::IMAGE_HEIGHT
            )
            : '';

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
            'userId' => 'required',
            'content' => 'required'
        ]);

        $comment = new PetAdComment();
        $comment->pet_ad_id = $commentData->petAdId;
        $comment->user_id = $commentData->userId;
        $comment->content = $commentData->content;

        if ($comment ->save()) {
            return $comment;
        }

        return null;
    }
}