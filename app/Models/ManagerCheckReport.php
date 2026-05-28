<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

#[Fillable('manager_id','report_id','seen','response')]
class ManagerCheckReport extends Pivot
{
    public function report(): BelongsTo{
        return $this->belongsTo(Report::class);
    }
    public function manager(): BelongsTo{
        return $this->belongsTo(User::class,'manager_id');
    }
}
