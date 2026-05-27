<?php

namespace App\Services;

use App\Models\File;
use File as FileFacade;
use Illuminate\Http\UploadedFile;
use Storage;

class FileService
{
    public static function upload(UploadedFile $file, string $path, bool $public = false): File
    {
        $disk = $public ? 'public' : 'local';

        $path = $file->store($path, $disk);
        $fullPath = Storage::disk($disk)->path($path);
        return File::create([
            'path' => $path,
            'name' => FileFacade::name($fullPath),
            'original_name' => FileFacade::name($file->getClientOriginalName()),
            'extension' => FileFacade::extension($fullPath),
            'size' => FileFacade::size($fullPath),
            'mime_type' => FileFacade::mimeType($fullPath),
            'disk' => $disk,
        ]);
    }
}
