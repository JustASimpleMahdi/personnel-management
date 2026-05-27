<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Report;
use Storage;

class FileController extends Controller
{
    public function reportFile(File $file){
        if(!auth()->user()->reports->some(fn(Report $report) => $report->files()->where('file_id',$file->id)->exists()))
            abort(403);

        return Storage::disk($file->disk)->download($file->path, $file->filename);
    }
}
