<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{
    public function saveFile($file): string
    {
        return Storage::url(
            Storage::disk('public')->put('test', $file)
        );
    }
}
