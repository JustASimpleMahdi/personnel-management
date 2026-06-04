<?php

namespace App\Models;

use App\Casts\JalaliCast;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Morilog\Jalali\Jalalian;

#[Fillable('title', 'text')]
class Suggestion extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilterByDateRange($query, ?string $from, ?string $to)
    {
        $fromCarbon = $from ? Jalalian::fromFormat('Y/m/d', $from)->toCarbon()->startOfDay() : null;
        $toCarbon = $to ? Jalalian::fromFormat('Y/m/d', $to)->toCarbon()->endOfDay() : null;

        if ($fromCarbon) {
            $query->where('created_at', '>=', $fromCarbon);
        }
        if ($toCarbon) {
            $query->where('created_at', '<=', $toCarbon);
        }

        return $query;
    }
    protected function casts()
    {
        return [
            'created_at' => JalaliCast::class
        ];
    }
}
