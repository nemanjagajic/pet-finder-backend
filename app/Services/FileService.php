<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Constants\Constants;
use App\Constants\PathConstants;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class FileService
{
    /**
     * Resizes to maxWidth and maxHeight, keeping the image aspect ratio
     *
     * @param UploadedFile $image
     * @param int $maxWidth
     * @param int $maxHeight
     * @return string
     */
    public function resizeAndSaveImage(UploadedFile $image, int $maxWidth, int $maxHeight): string
    {
        $image = Image::make($image);
        $image->orientate();
        $resizedImage = $image->resize($maxWidth, $maxHeight, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $resizedImage = $resizedImage->encode('jpg');
        $imageName = Str::random(Constants::RANDOM_IMAGE_NAME_LENGTH).'.jpg';
        $this->saveImage($imageName, $resizedImage);
        return $imageName;
    }
    /**
     * Saves provided image to the given path
     *
     * @param string $path
     * @param $image
     * @return string
     */
    public function saveImage(string $path, $image)
    {
        return Storage::disk('local')->put(PathConstants::PUBLIC_IMAGES_PATH.$path, $image);
    }
    /**
     * Deletes image with the given path
     *
     * @param $path
     */
    public function deleteImage($path)
    {
        Storage::delete(PathConstants::PUBLIC_IMAGES_PATH.$path);
    }
}