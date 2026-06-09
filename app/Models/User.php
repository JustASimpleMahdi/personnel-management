<?php

namespace App\Models;

use App\Classes\DayWorkHours;
use App\UserShiftEnum;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Morilog\Jalali\Jalalian;

#[Fillable(['firstname',
    'lastname',
    'username',
    'password',
    'national_code',
    'salary',
    'phone',
    'address',
    'shift',
    'role_id'
])]
#[Hidden(['password', 'remember_token'])]
class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract
{
    use HasFactory, Notifiable;
    use Authorizable, Authenticatable;

    protected static function booted(): void
    {
        static::updated(function (User $user) {
            if (!($user->wasChanged('salary') || $user->wasChanged('shift'))) return;

            $currentMonthSalary = $user->currentMonthSalary()->firstOrNew();
            $currentMonthSalary->save();
        });
    }

    public function currentMonthSalary()
    {
        $now = Jalalian::now();
        return $this->hasOne(Salary::class)
            ->where('year', $now->getYear())->where('month', $now->getMonth());
    }

    public function monthSalary(int $year, int $month): Salary|null
    {
        return $this->salaries()->where('year', $year)->where('month', $month)->first();
    }

    public function salaries(): HasMany
    {
        return $this->hasMany(Salary::class);
    }

    public function suggestions(): HasMany
    {
        return $this->hasMany(Suggestion::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function redirectRoute(): string
    {
        return route($this->role->key->value . '.index');
    }

    protected function todayWorkHours(): Attribute
    {
        return Attribute::get(fn() => new DayWorkHours($this->workHours()->whereDate('date', '=', now())->get(), Jalalian::now()));
    }

    public function workHours(): HasMany
    {
        return $this->hasMany(WorkHour::class);
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'shift' => UserShiftEnum::class
        ];
    }

    protected function fullname(): Attribute
    {
        return Attribute::get(fn() => $this->firstname . ' ' . $this->lastname);
    }
}
