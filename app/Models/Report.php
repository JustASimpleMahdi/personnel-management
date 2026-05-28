<?php

namespace App\Models;

use App\Casts\JalaliCast;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Morilog\Jalali\Jalalian;

#[Fillable('title', 'description')]
class Report extends Model
{
    protected static function booted(): void
    {
        static::deleted(function ($report) {
            $report->files->each(fn($file) => $file->delete());
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class, ReportFile::class);
    }

    public function manager_check(): HasOne
    {
        return $this->hasOne(ManagerCheckReport::class);
    }

    protected function isSeen(): Attribute
    {
        return Attribute::get(fn() => (bool)$this->manager_check?->seen);
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

    public function scopeFilterByRoles($query, Collection $roles): mixed
    {
        if ($roles->isEmpty()) {
            return $query;
        }
        $query->whereHas('user.role', function ($query) use ($roles) {
            $query->whereIn('key', $roles->toArray());
        });
        return $query;
    }

    public function scopeFilterBySeen($query, $seen)
    {
        if (!$seen) {
            return $query;
        }

        $isSeen = (bool)$seen;

        $query->where(function ($q) use ($isSeen) {
            if ($isSeen) {
                $q->whereHas('manager_check', fn($sub) => $sub->where('seen', true));
            }
        });

        return $query;
    }

    protected function casts(): array
    {
        return [
            'created_at' => JalaliCast::class,
            'updated_at' => JalaliCast::class,
        ];
    }
}
