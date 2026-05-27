<?php

namespace App\Models;

use App\Casts\JalaliCast;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable('title','description')]
class Report extends Model
{
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function files(): BelongsToMany{
        return $this->belongsToMany(File::class,ReportFile::class);
    }

    protected function casts(): array{
        return [
            'created_at' => JalaliCast::class,
            'updated_at' => JalaliCast::class,
        ];
    }
}
