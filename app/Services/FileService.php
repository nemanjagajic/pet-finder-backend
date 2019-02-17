<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{
    /**
     * Stores image to provided location
     * and returns the name of image with extension
     *
     * @param $image
     * @return string
     */
    public static function saveImage($image): string
    {
        $storedImage = Storage::disk('local')->put('public/images', $image);
        $storedImageParts = explode('/', $storedImage);
        return $storedImageParts[sizeof($storedImageParts) - 1];
    }
}