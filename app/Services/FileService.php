<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{
    public static function saveFile(mixed $file, string $path = '/'): string
    {
        return Storage::url(
            Storage::disk('public')->put($path, $file)
        );
    }

    public static function deleteFile(string $file): void
    {
        Storage::disk('public')->delete($file);
    }
}
