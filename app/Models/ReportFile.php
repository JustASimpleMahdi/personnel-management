<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

#[Fillable('report_id','file_id')]
class ReportFile extends Pivot
{
    protected static function booted(): void
    {
        static::deleted(function(ReportFile $report){
            $report->file->delete();
        });
    }
    public function report(): BelongsTo{
        return $this->belongsTo(Report::class);
    }
    public function file(): BelongsTo{
        return $this->belongsTo(File::class);
    }
}
