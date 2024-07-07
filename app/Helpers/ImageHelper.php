<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Get the full URL for an image from storage.
     *
     * @param string $path The path of the image in storage
     * @param string $disk The storage disk (default: 'public')
     * @return string|null The full URL of the image or null if not found
     */
    public static function getImageUrl(string $path, string $disk = 'public'): ?string
    {
        if (Storage::disk($disk)->exists($path)) {
            return Storage::disk($disk)->url($path);
        }
        return null;
    }

    /**
     * Get the contents of an image from storage.
     *
     * @param string $path The path of the image in storage
     * @param string $disk The storage disk (default: 'public')
     * @return string|null The contents of the image or null if not found
     */
    public static function getImageContents(string $path, string $disk = 'public'): ?string
    {
        if (Storage::disk($disk)->exists($path)) {
            return Storage::disk($disk)->get($path);
        }
        return null;
    }
}
