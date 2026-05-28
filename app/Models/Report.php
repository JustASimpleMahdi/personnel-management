<?php

namespace App\Models;

use App\Casts\JalaliCast;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable('title','description')]
class Report extends Model
{
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function files(): BelongsToMany{
        return $this->belongsToMany(File::class,ReportFile::class);
    }
    public function manager_check(): HasOne{
        return $this->hasOne(ManagerCheckReport::class);
    }

    protected function isSeen(): Attribute{
        return Attribute::get(fn()=> (bool) $this->manager_check?->seen);
    }
    protected function casts(): array{
        return [
            'created_at' => JalaliCast::class,
            'updated_at' => JalaliCast::class,
        ];
    }
}
