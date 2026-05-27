<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Storage;

#[Fillable(['name', 'original_name', 'path', 'extension', 'mime_type', 'size', 'disk'])]
class File extends Model
{
    protected static function booted(): void
    {
        static::deleted(function (File $file) {
            if (Storage::disk($file->disk)->exists($file->path))
                Storage::disk($file->disk)->delete($file->path);
        });
    }

    protected function filename(): Attribute
    {
        return Attribute::get(fn() => $this->original_name . '.' . $this->extension);
    }

    protected function url(): Attribute
    {
        return Attribute::get(function () {
            if ($this->disk !== 'public') throw new Exception("The file (file_id=$this->id) disk must be public.");
            return Storage::disk($this->disk)->url($this->path);
        });
    }

    public function isImage(): bool
    {
        return Str::startsWith($this->mime_type, 'image/');
    }
}
