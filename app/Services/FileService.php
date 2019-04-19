<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{
    public function saveImage($image): string
    {
        $storedImage = Storage::disk('local')->put('public/images', $image);
        $storedImageParts = explode('/', $storedImage);
        return $storedImageParts[sizeof($storedImageParts) - 1];
    }
}