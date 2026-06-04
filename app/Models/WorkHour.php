<?php

namespace App\Models;

use App\Casts\JalaliCast;
use App\Casts\JalaliDateCast;
use App\Casts\TimeCast;
use App\WorkHourShiftEnum;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('start', 'end', 'date', 'shift')]
class WorkHour extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'shift' => WorkHourShiftEnum::class,
            'date' => JalaliCast::class,
            'start' => TimeCast::class,
            'end' => TimeCast::class,
        ];
    }
}
